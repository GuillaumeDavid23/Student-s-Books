let selectClass = document.getElementById('selectClass')
let formClass = document.getElementById('formClass')

selectClass.addEventListener('change', function (e) {
    if (selectClass.value != '') {
        formClass.submit();
    }
})