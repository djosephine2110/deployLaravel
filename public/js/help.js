function tgl(event) {
    const waktu = document.getElementsByClassName("waktu");
    const awal = waktu[0]
    const akhir = waktu[1]
    var date = new Date($(awal).val());
    var date2 = new Date($(akhir).val());
    var day1 = date.getDate();
    var month1 = date.getMonth() + 1;
    var year1 = date.getFullYear();
    var day2 = date2.getDate();
    var month2 = date2.getMonth() + 1;
    var year2 = date2.getFullYear();
    dAwal = [month1, day1, year1].join('')
    dAkhir = [month2, day2, year2].join('')
    if (parseInt(dAwal) > parseInt(dAkhir)) {
        event.preventDefault();
        alert(`Tanggal tidak boleh mundur`);
    }
}

function testToggle() {
    let btnToggle = document.getElementsByName("reqDate");
    let roww = document.getElementById("table")
    let colStart = document.getElementsByClassName("dStart");
    let colEnd = document.getElementsByClassName("dEnd");
    let angka = []
    for (let i = 0; i < roww.rows.length; i++) {
        angka.push(i)
    }
    if (btnToggle[0].value == "tasks.created_at") {
        btnToggle[0].value = "tasks.updated_at"
        btnToggle[1].innerHTML = "Date Updated"
        angka.forEach(element => {
            colStart[element].style.backgroundColor = "white";
            colEnd[element].style.backgroundColor = "pink";
        });
    } else {
        btnToggle[0].value = "tasks.created_at"
        btnToggle[1].innerHTML = "Date Created"
        angka.forEach(element => {
            colStart[element].style.backgroundColor = "pink";
            colEnd[element].style.backgroundColor = "white";
        });
    }
}

$(function() {
    $('div[onload]').trigger('onload');
});