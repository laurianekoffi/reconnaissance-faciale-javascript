
var video = document.getElementById('video');
var canvas = document.getElementById('canvas');

Promise.all([
    faceapi.nets.tinyFaceDetector.loadFromUri('./models'),
    faceapi.nets.faceLandmark68Net.loadFromUri('./models'),
    faceapi.nets.faceRecognitionNet.loadFromUri('./models')
  ]).then(run())


async function run() {
  if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: { width: { exact: 640 }, height: { exact: 480 } } })
      .then(function (stream) {
        video.srcObject = stream;
      })
      .catch(function (err) {
        console.log("Something went wrong!");
      });
  }
}

  video.addEventListener('play', async (e)=>{

    var ImageRef = document.getElementById('user');

    var resRef = await faceapi.detectSingleFace(ImageRef, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceDescriptor();
    var faceMatcher = new faceapi.FaceMatcher(resRef);
    displaySize = {
      width: 640,
      height: 480
    }

    setInterval( async()=> {
      canvas.innerHTML = faceapi.createCanvasFromMedia(video);
      faceapi.matchDimensions(canvas, displaySize);
      var query = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceDescriptors();
  
      const queryDrawBox = query.map(async (res)=>{
        const bestMatch = faceMatcher.findBestMatch(res.descriptor)
        if(bestMatch.distance < 0.40) {
          // pointage et rediredction
          location.href = "index.php";
          console.log("je suis lolo");
        }
      })
      let resizeDis = faceapi.resizeResults(query, displaySize);
      faceapi.draw.drawFaceLandmarks(canvas, resizeDis);
    }, 100);
   
  })
  