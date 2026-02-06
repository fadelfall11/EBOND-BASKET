import Cropper from 'cropperjs';
import 'cropperjs/dist/cropper.min.css';

window.initCropper = function(inputSelector, imageSelector, cropDataInputSelector) {
    let cropper;
    const input = document.querySelector(inputSelector);
    const image = document.querySelector(imageSelector);
    const cropDataInput = document.querySelector(cropDataInputSelector);

    if (!input || !image) return;

    input.addEventListener('change', function(e) {
        const files = e.target.files;
        if (files && files.length > 0) {
            const reader = new FileReader();
            reader.onload = function(event) {
                image.src = event.target.result;
                if (cropper) cropper.destroy();
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                    movable: true,
                    zoomable: true,
                    rotatable: false,
                    scalable: false,
                    crop(event) {
                        if (cropDataInput) {
                            cropDataInput.value = JSON.stringify(cropper.getData());
                        }
                    }
                });
            };
            reader.readAsDataURL(files[0]);
        }
    });
};
