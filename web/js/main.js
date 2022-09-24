const toggleTable = (id) => {
    let table = document.getElementById('schedule' + id);
    let changeDiv = document.getElementById('change' + id);

    table.classList.toggle('invisible');
    changeDiv.classList.toggle('invisible');
}