// mascara de dinheiro
$('.money').mask('#.##0,00', {reverse: true});
// mascara de cep
$('.zip_code').mask('00000-000');
// mascara de cpf
$('.cpf').mask('000.000.000-00');

// retorna o nome do status pelo sua sigla referente enviada
function scheduledClassResultStatus(val)
{
    const class_result = {'P':'Presente','F':'Falta','FJ':'Falta Justificada','CH':'Chuva','FP':'Falta do Professor'};
    
    return `${class_result[val]}`
}

// retorna a class do status pelo sua sigla referente enviada
function scheduledClassResultStatusClass(val)
{
    const class_result = {'P':'success','F':'danger','FJ':'warning','CH':'info','FP':'warning'};
    
    return `${class_result[val]}`
}

// retorna o nome do dia da semana pelo seu numero referente enviado
function weekDayDescription(val)
{
    const week_day_description = {1:'Segunda',2:'Terça',3:'Quarta',4:'Quinta',5:'Sexta',6:'Sábado',7:'Domingo'};
    
    if(val > 0 && val < 8){
        return `${week_day_description[val]}`
    }else{
        return `Dia não identificado`
    }
}

// retorna o nome do mes pelo seu numero referente enviado
function monthDescription(val)
{
    const month_description = {1:'Janeiro',2:'Fevereiro',3:'Março',4:'Abril',5:'Maio',6:'Junho',7:'Julho',8:'Agosto',9:'Setembro',10:'Outubro',11:'Novembro',12:'Dezembro'};
    
    if(val > 0 && val <= 12){
        return `${month_description[val]}`
    }else{
        return `Mês não identificado`
    }
}

// retorna a class do status da fatura
function InvoicesStatusClass(val)
{
    const class_result = {'A':'primary','C':'danger','R':'success'};
    
    return `${class_result[val]}`
}

// retorna a class do status da fatura
function InvoicesStatusName(val)
{
    const class_result = {'A':'Aberta','C':'Cancelada','R':'Recebida'};
    
    return `${class_result[val]}`
}

// retorna o nome do objetivo do aluno
function objectiveName(val)
{
    const result = {'evolucao':'Evolução','prazer':'Prazer','suor':'Suor'};
    
    return `${result[val]}`
}

// retorna o nome do status dos interesses
function interestStatusName(val)
{
    const result = {
            'A':'Pendente',
            'DS':'Desistiu',
            'NHD':'Sem horário',
            'MA':'Marcou avaliação',
            'STA':'Se tornou aluno',
        };
    
    return `${result[val]}`
}

// retorna a classe do status dos interesses
function interestStatusClass(val)
{
    const result = {
            'A':'primary',
            'DS':'danger',
            'NHD':'warning',
            'MA':'info',
            'STA':'success',
        };
    
    return `${result[val]}`
}

// retorna a periodicidade do plano pelo seu numero referente enviado
function periodContractedDescription(val)
{
    const period_cantracted_description = {1:'Mensal',2:'Bimestral',3:'Trimestral',4:'Quadrimestral',6:'Semestral',12:'Anual',13:'Anual - (Tenis +)'};
    
    return `${period_cantracted_description[val]}`
}

// retorna o plano do aluno pelo seu numero referente enviado
function getAgeRange(val)
{
    const age_range_description = {1:'Infantil',
                                   2:'Juvenil',
                                   3:'Adulto',
                                   4:'Pré Equipe',
                                   5:'Pacote de Aulas',
                                   6:'GynPass'};
    
    if(val > 0 && val <= 6){
        return `${age_range_description[val]}`
    }else{
        return ``
    }
}

// retorna o perio do dia pelo seu numero referente enviado
function getDayPeriod(val)
{
    const day_period_description = {1:'Diurno',2:'Noturno'};
    
    if(val > 0 && val < 3){
        return `${day_period_description[val]}`
    }else{
        return ``
    }
}

// pega o dia da semana informado em JS e passa para o padrão do PHP
function week_dayPhpToJs(week_day)
{
    const week_day_js = {7:'2', 1:'3', 2:'4', 3:'5', 4:'6', 5:'0', 6:'1'};
    
    return `${week_day_js[week_day]}`
    
}

// mascara de telefone
var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},
spOptions = {
onKeyPress: function(val, e, field, options) {
    field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};
$('.phone').mask(SPMaskBehavior, spOptions);

// mascara de dinheiro em reais
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

// formata a data com hora e minuto
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

// formata a data em dia, mes e ano
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

// automatização de funções do sweet alert 2
function showError(text = "Ocorreu um erro!")
{
    Swal.fire({ type: 'error', text: text, showConfirmButton: true })
}

function showSuccess(title = null, text = null, functions = null, param = null)
{
    if(functions){
        if(title && text == null)
            Swal.fire({ type: 'success', title: title, showConfirmButton: false, timer: 1000, onClose: () => { functions(param); } })
        else if(title && text)
            Swal.fire({ type: 'success', title: title, text: text, showConfirmButton: false, timer: 1000, onClose: () => { functions(param); } })
    }else{
        if(title && text == null)
            Swal.fire({ type: 'success', title: title, showConfirmButton: false, timer: 1000 })
        else if(title && text)
            Swal.fire({ type: 'success', title: title, text: text, showConfirmButton: false, timer: 1000 })
    }

}

// BUSCA DE ENDEREÇO
$("#zip_code, #zip_code_edit, #responsible_zip_code, #responsible_zip_code_edit").on("keyup", function(){

    if($(this).val().length == 9){

        let type = $(this).data('type');
        let zip_code = $(this).val();

        zip_code = zip_code.replace("-","");

        Swal.queue([
            {
                title: "Carregando...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.get(`https://viacep.com.br/ws/${zip_code}/json`, { })
                        .then(function (data) {

                            if(data.erro){
                                showError("Cep não encontrado!")
                                return false;
                            }

                            switch (type) {
                                case 'add':

                                    $("#uf").prop("readonly", true)
                                    $("#city").prop("readonly", true)
                                    $("#neighborhood").prop("readonly", true)
                                    $("#address").prop("readonly", true)
                                    
                                    $("#uf").val(data.uf);
                                    $("#city").val(data.localidade);
                                    $("#neighborhood").val(data.bairro);
                                    $("#address").val(data.logradouro);
    
                                    if(data.uf == "")
                                        $("#uf").prop("readonly", false)
    
                                    if(data.localidade == "")
                                        $("#city").prop("readonly", false)
    
                                    if(data.bairro == "")
                                        $("#neighborhood").prop("readonly", false)
    
                                    if(data.logradouro == "")
                                        $("#address").prop("readonly", false)
                                    
                                    break;
                                
                                case 'edit':

                                    $("#uf_edit").prop("readonly", true)
                                    $("#city_edit").prop("readonly", true)
                                    $("#neighborhood_edit").prop("readonly", true)
                                    $("#address_edit").prop("readonly", true)
                                    
                                    $("#uf_edit").val(data.uf);
                                    $("#city_edit").val(data.localidade);
                                    $("#neighborhood_edit").val(data.bairro);
                                    $("#address_edit").val(data.logradouro);
    
                                    if(data.uf == "")
                                        $("#uf_edit").prop("readonly", false)
    
                                    if(data.localidade == "")
                                        $("#city_edit").prop("readonly", false)
    
                                    if(data.bairro == "")
                                        $("#neighborhood_edit").prop("readonly", false)
    
                                    if(data.logradouro == "")
                                        $("#address_edit").prop("readonly", false)
                                    
                                    break;
                                
                                case 'add-responsible':

                                    $("#responsible_uf").prop("readonly", true)
                                    $("#responsible_city").prop("readonly", true)
                                    $("#responsible_neighborhood").prop("readonly", true)
                                    $("#responsible_address").prop("readonly", true)
                                    
                                    $("#responsible_uf").val(data.uf);
                                    $("#responsible_city").val(data.localidade);
                                    $("#responsible_neighborhood").val(data.bairro);
                                    $("#responsible_address").val(data.logradouro);
    
                                    if(data.uf == "")
                                        $("#responsible_uf").prop("readonly", false)
    
                                    if(data.localidade == "")
                                        $("#responsible_city").prop("readonly", false)
    
                                    if(data.bairro == "")
                                        $("#responsible_neighborhood").prop("readonly", false)
    
                                    if(data.logradouro == "")
                                        $("#responsible_address").prop("readonly", false)
                                    
                                    break;
                                
                                case 'edit-responsible':

                                    $("#responsible_uf_edit").prop("readonly", true)
                                    $("#responsible_city_edit").prop("readonly", true)
                                    $("#responsible_neighborhood_edit").prop("readonly", true)
                                    $("#responsible_address_edit").prop("readonly", true)
                                    
                                    $("#responsible_uf_edit").val(data.uf);
                                    $("#responsible_city_edit").val(data.localidade);
                                    $("#responsible_neighborhood_edit").val(data.bairro);
                                    $("#responsible_address_edit").val(data.logradouro);
    
                                    if(data.uf == "")
                                        $("#responsible_uf_edit").prop("readonly", false)
    
                                    if(data.localidade == "")
                                        $("#responsible_city_edit").prop("readonly", false)
    
                                    if(data.bairro == "")
                                        $("#responsible_neighborhood_edit").prop("readonly", false)
    
                                    if(data.logradouro == "")
                                        $("#responsible_address_edit").prop("readonly", false)
                                    
                                    break;
                            
                                default:
                                    break;
                            }

                            if(type == 'add'){
                                
                                
                                    
                            }else{

                                
                                
                            }

                            Swal.close();

                        })
                        .catch();
                },
            },
        ]);
    }
})

function resetReadOnly()
{
    $("#uf").prop("readonly", false)
    $("#city").prop("readonly", false)
    $("#neighborhood").prop("readonly", false)
    $("#address").prop("readonly", false)

    $("#uf_edit").prop("readonly", false)
    $("#city_edit").prop("readonly", false)
    $("#neighborhood_edit").prop("readonly", false)
    $("#address_edit").prop("readonly", false)

    $("#responsible_uf").prop("readonly", false)
    $("#responsible_city").prop("readonly", false)
    $("#responsible_neighborhood").prop("readonly", false)
    $("#responsible_address").prop("readonly", false)

    $("#responsible_uf_edit").prop("readonly", false)
    $("#responsible_city_edit").prop("readonly", false)
    $("#responsible_neighborhood_edit").prop("readonly", false)
    $("#responsible_address_edit").prop("readonly", false)
}