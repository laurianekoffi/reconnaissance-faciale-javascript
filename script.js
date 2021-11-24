
// const imageUpload = document.getElementById('imageUpload')

// function loadLabeledImages() {
//   const labels = ['donald', 'lorie', 'marc', 'mex']
//   return Promise.all(
//     labels.map(async label => {
//       const descriptions = []
//       for (let i = 1; i <= 2; i++) {
//         const img = await faceapi.fetchImage(`./labeled_images/${label}/${i}.jpg`)
//         const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
//         descriptions.push(detections.descriptor)
//       }
//       return new faceapi.LabeledFaceDescriptors(label, descriptions)
//     })
//   )
// }

// async function start() {
//   const container = document.createElement('div')
//   container.style.position = 'relative'
//   document.body.append(container)
//   const labeledFaceDescriptors = await loadLabeledImages();
//   const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6)
//   let image
//   let canvas
//   document.body.append('Loaded')
//   imageUpload.addEventListener('change', async () => {
//     if (image) image.remove()
//     if (canvas) canvas.remove()
//     image = await faceapi.bufferToImage(imageUpload.files[0])
//     container.append(image)
//     canvas = faceapi.createCanvasFromMedia(image)
//     container.append(canvas)
//     const displaySize = { width: image.width, height: image.height }
//     faceapi.matchDimensions(canvas, displaySize)
//     const detections = await faceapi.detectAllFaces(image).withFaceLandmarks().withFaceDescriptors()
//     const resizedDetections = faceapi.resizeResults(detections, displaySize)
//     const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
//     results.forEach((result, i) => {
//       const box = resizedDetections[i].detection.box
//       const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() })
//       drawBox.draw(canvas)
//     })
//   })
// }

// Promise.all([
//   faceapi.nets.tinyFaceDetector.loadFromDisk('./models'),
//   faceapi.nets.faceLandmark68Net.loadFromDisk('./models'),
//   faceapi.nets.faceRecognitionNet.loadFromDisk('./models')
// ]).then(start())


// console.log('models disponible', faceapi.nets);


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


  video.addEventListener('play',  (e)=>{
    displaySize = {
      width: 640,
      height: 480
    }
    setInterval( async()=> {
      canvas.innerHTML = faceapi.createCanvasFromMedia(video);
      faceapi.matchDimensions(canvas, displaySize);
      var query = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks();
  
      // console.log(query);
      let resizeDis = faceapi.resizeResults(query, displaySize);
      faceapi.draw.drawFaceLandmarks(canvas, resizeDis);
    }, 100);
   
  })
  // il faut chercher faceMatcher
