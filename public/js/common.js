
const week_day_description = {1:'Segunda',2:'Terça',3:'Quarta',4:'Quinta',5:'Sexta',6:'Sábado',7:'Domingo'};

$('.money').mask('#.##0,00', {reverse: true});
$('.zip_code').mask('00000-000');
$('.cpf').mask('000.000.000-00');


var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
spOptions = {
onKeyPress: function(val, e, field, options) {
    field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};

$('.phone').mask(SPMaskBehavior, spOptions);


function moneyFormat(money)
{   
    let cash = parseFloat(money).toFixed(2).toString().replace('.', ',')

    if(cash.length >= 7 && cash.length <= 9){
        return `${cash.substr(0, (cash.length-6))}.${cash.substr(-6, 7)}`;
    }else if(cash.length > 9){
        return `${cash.substr(0, (cash.length-9))}.${cash.substr((cash.length-9), (cash.length-7))}.${cash.substr(-6, 7)}`;
    }else{
        return `${cash}`;
    }
}

function dateFormatFull(date)
{
    if(date == null || date == undefined || date == ''){
        return '';
    }else{

        const dt = date.split(' ');

        const dia = dt[0].split('-')[2];
        const mes = dt[0].split('-')[1];
        const ano = dt[0].split('-')[0];
        const hora = dt[1].split(':')[0];
        const min = dt[1].split(':')[1];

        return `${dia}/${mes}/${ano} ${hora}:${min}`;
    }
}

function dateFormat(date)
{
    if(date == null || date == undefined || date == ''){
        return '';
    }else{

        const dt = date.split(' ');

        const dia = dt[0].split('-')[2];
        const mes = dt[0].split('-')[1];
        const ano = dt[0].split('-')[0];

        return `${dia}/${mes}/${ano}`;
    }
}



function showError(text = null)
{
    if(text)
        Swal.fire({ type: 'error', text: text, showConfirmButton: true })
}

function showSuccess(title = null, text = null)
{
    if(title && text == null)
        Swal.fire({ type: 'success', title: title, showConfirmButton: false, timer: 1500 })
    else if(title && text)
        Swal.fire({ type: 'success', title: title, text: text, showConfirmButton: false, timer: 1500 })
}
