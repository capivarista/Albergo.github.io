const colorInput = document.querySelector('.color-input');
const colorPicker = document.querySelector('.color-picker');
const startDayInput = document.querySelector('.start-day');
const endDayInput = document.querySelector('.end-day');
const changeColorButton = document.querySelector('.change-color-button');
const changeBgColorButton = document.querySelector('.change-bg-color-button');
const resetColorsButton = document.querySelector('.reset-colors-button')
const days = document.querySelectorAll('.day');
const targetDiv = document.getElementById('sessaoCalendario');

function changeDaysColor(start, end, color) {
    for (let i = start - 1; i <= end - 1; i++) {
        days[i].style.backgroundColor = color;
    }
}

function changeDivColor(color) {
    targetDiv.style.backgroundColor = color;
}
function resetColors(color, dayColors){


    targetDiv.style.backgroundColor = color;
    for(let i = 0; i <=31 ; i++){

      days[i].style.backgroundColor = dayColors;
    }


}

colorPicker.addEventListener('input', (e) => {
    colorInput.value = e.target.value;
});

changeColorButton.addEventListener('click', () => {
    const color = colorInput.value;
    const startDay = parseInt(startDayInput.value);
    const endDay = parseInt(endDayInput.value);

    if (isNaN(startDay) || isNaN(endDay) || startDay < 1 || endDay > 31 || startDay > endDay) {
        alert('Por favor, insira um intervalo válido de dias.');
        return;
    }

    if (/^#[0-9A-F]{6}$/i.test(color)) {
        changeDaysColor(startDay, endDay, color);
    } else {
        alert('Por favor, insira um código hexadecimal válido.');
    }
});

changeBgColorButton.addEventListener('click', () => {
    const color = colorInput.value;

    if (/^#[0-9A-F]{6}$/i.test(color)) {
        changeDivColor(color);
    } else {
        alert('Por favor, insira um código hexadecimal válido.');
    }
});

resetColorsButton.addEventListener('click', () => {

    color = "#00BF63";
    dayColors = "#ffffff"
    resetColors(color, dayColors);

});


