// Appending <option> elements
const select = document.getElementById('price-slider');

// Append the option elements
for (let i:number = -20; i <= 40; i++) {

    let option = document.createElement("option");
    option.text = i;
    option.value = i;

    select.appendChild(option);
}
// Initializing the slider
let html5Slider = document.getElementById('html5');

noUiSlider.create(html5Slider, {
    start: [10, 30],
    connect: true,
    range: {
        'min': -20,
        'max': 40
    }
});
// Updating the <select> and <input>
let inputNumber = document.getElementById('input-number');

html5Slider.noUiSlider.on('update', function (values, handle) {

    let value = values[handle];

    if (handle) {
        inputNumber.value = value;
    } else {
        select.value = Math.round(value);
    }
});

select.addEventListener('change', function () {
    html5Slider.noUiSlider.set([this.value, null]);
});

inputNumber.addEventListener('change', function () {
    html5Slider.noUiSlider.set([null, this.value]);
});