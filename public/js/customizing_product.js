const canvas = new fabric.Canvas('designCanvas');
const canvasElement = document.getElementById('designCanvas');
const productImage = canvasElement.getAttribute('data-bg');

function showTextControls() {
    document.getElementById('textControls').style.display = 'block';
    document.getElementById('imageControls').style.display = 'none';
    document.getElementById('stickerControls').style.display = 'none';
}

function showImageControls() {
    document.getElementById('textControls').style.display = 'none';
    document.getElementById('imageControls').style.display = 'block';
    document.getElementById('stickerControls').style.display = 'none';
}

function showStickerControls() {
    document.getElementById('textControls').style.display = 'none';
    document.getElementById('imageControls').style.display = 'none';
    document.getElementById('stickerControls').style.display = 'block';
}

// Rest of your JavaScript code...


// Background Image
fabric.Image.fromURL(productImage, function (img) {
    const scaleX = canvas.width / img.width;
    const scaleY = canvas.height / img.height;
    img.set({ originX: 'left', originY: 'top', selectable: false });
    canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), { scaleX, scaleY });
});

// Text Tools
function addText() {
    const text = new fabric.IText('Your Text Here', { left: 100, top: 100, fill: '#000', fontSize: 24 });
    canvas.add(text).setActiveObject(text);
    showTextToolbar();
    document.getElementById('removeAllTextsBtn').style.display = 'inline-block';
}

function showTextToolbar() {
    const obj = canvas.getActiveObject();
    document.getElementById('textToolbar').style.display = (obj && obj.type === 'i-text') ? 'block' : 'none';
}

canvas.on('object:selected', showTextToolbar);
canvas.on('selection:cleared', () => document.getElementById('textToolbar').style.display = 'none');

function toggleBold() {
    const obj = canvas.getActiveObject();
    if (obj?.type === 'i-text') {
        obj.fontWeight = obj.fontWeight === 'bold' ? 'normal' : 'bold';
        canvas.renderAll();
    }
}

function toggleUnderline() {
    const obj = canvas.getActiveObject();
    if (obj?.type === 'i-text') {
        obj.underline = !obj.underline;
        canvas.renderAll();
    }
}

function changeTextColor(color) {
    const obj = canvas.getActiveObject();
    if (obj?.type === 'i-text') {
        obj.set({ fill: color });
        canvas.renderAll();
    }
}
function changeFontFamily(font) {
    const obj = canvas.getActiveObject();
    if (obj?.type === 'i-text') {
        obj.set({ fontFamily: font });
        canvas.renderAll();
    }
}


// Image Upload
function addImage(event) {
    const reader = new FileReader();
    reader.onload = function (e) {
        fabric.Image.fromURL(e.target.result, function (img) {
            img.scaleToWidth(150);
            img.set({ left: 120, top: 120, selectable: true });
            canvas.add(img).setActiveObject(img);
            document.getElementById('removeAllImagesBtn').style.display = 'inline-block';
        });
    };
    reader.readAsDataURL(event.target.files[0]);
}

// Overlay Color
let overlayRect;
function changeOverlayColor(color) {
    if (overlayRect) canvas.remove(overlayRect);
    overlayRect = new fabric.Rect({
        left: 0, top: 0,
        width: canvas.width,
        height: canvas.height,
        fill: color,
        opacity: 0.3,
        selectable: false
    });
    canvas.add(overlayRect);
    overlayRect.moveTo(0);
    canvas.renderAll();
}

// Stickers
document.getElementById('removeAllStickersBtn').style.display = 'none'; // Initially hidden

function addSticker(path) {
    fabric.loadSVGFromURL(`/img/stickers/${path}`, function (objects, options) {
        const sticker = fabric.util.groupSVGElements(objects, options);
        sticker.set({ left: 100, top: 100, scaleX: 0.5, scaleY: 0.5, selectable: true });
        canvas.add(sticker);
        canvas.setActiveObject(sticker);
        document.getElementById('deleteStickerBtn').style.display = 'inline-block';
        document.getElementById('removeAllStickersBtn').style.display = 'inline-block'; // Show the remove all button
    });
}

function loadStickers() {
    fetch('/js/stickers.json')
        .then(res => res.json())
        .then(data => {
            const panel = document.getElementById('stickerPanel');
            panel.innerHTML = '';
            data.forEach(sticker => {
                const btn = document.createElement('button');
                btn.innerHTML = `<img src="/img/stickers/${sticker.file}" alt="${sticker.name}" style="width:40px; height:40px;">`;
                btn.className = 'btn btn-light p-1';
                btn.onclick = () => addSticker(sticker.file);
                panel.appendChild(btn);
            });
        })
        .catch(err => console.error('Failed to load stickers:', err));
}

function deleteSelectedObject() {
    const activeObject = canvas.getActiveObject();
    if (activeObject) {
        canvas.remove(activeObject);
        canvas.discardActiveObject();
        document.getElementById('deleteStickerBtn').style.display = 'none';
    }
}

function removeAllTexts() {
    canvas.getObjects('i-text').forEach(obj => canvas.remove(obj));
    document.getElementById('removeAllTextsBtn').style.display = 'none';
}

function removeAllImages() {
    canvas.getObjects('image').forEach(obj => canvas.remove(obj));
    document.getElementById('removeAllImagesBtn').style.display = 'none';
}

function removeAllStickers() {
    canvas.getObjects().forEach(obj => {
        if (obj.type === 'group') {
            canvas.remove(obj);
        }
    });
    document.getElementById('removeAllStickersBtn').style.display = 'none';
}

canvas.on('object:selected', e => {
    const activeObject = e.target;
    if (activeObject) {
        document.getElementById('deleteStickerBtn').style.display = 'inline-block';
    }
});

canvas.on('selection:cleared', () => {
    document.getElementById('deleteStickerBtn').style.display = 'none';
});

// Form Submit
document.getElementById('cartForm').addEventListener('submit', function (e) {
    const dataURL = canvas.toDataURL('image/png');
    document.getElementById('customImageInput').value = dataURL;
});
