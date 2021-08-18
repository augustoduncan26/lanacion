$(document).ready(function(e){
    let error_server = 0;
    let data_insert  = 0;
    $('.alert').show().html('Connecting to swapi and downloading the data, please wait...');
    $.ajax({
        url: 'dbconnect/getValues.php', 
        dataType: 'text', 
        cache: false,
        contentType: false,
        processData: false,
        data: {},
        type: 'post',
        success: function (response) {
            if (response == '404') {
                $('.alert').removeClass('alert-info');
                $('.alert').addClass('alert-danger');
                $('.alert').show().html('Error: Page not found or there`s a error connecting the swapi.');
                error_server = 1;
            }
            if(response == 'ok') {
                $('.alert').show().html('Data save successfully');
                data_insert = 0;
                setTimeout(function(){
                    $('.alert').hide();
                },2000);
            }
            if (error_server == 0 && data_insert == 0) {
                postData = 'values';
                form_data = new FormData();
                form_data.append('query','okay');
                $.ajax({
                    url:'dbconnect/getValues.php',
                    dataType: 'json',
                    data:form_data,
                    contentType: false,
                    processData: false,
                    type: 'post',
                    success: function (response) {
                    $('.select-starships').append(response.starships);
                    $('.select-vehicles').append(response.vehicles);
                    $('.totalRegsStarships').text('Total Starships: ' + response.totalStarships);
                    $('.totalRegsVehicles').text('Total Vehicles: ' + response.totalVehicles);
                    },
                    error: function (response) {
                    }
                });
            }
            $('.alert').hide();
        },
        error: function (response) {
            console.log('Error: ' + response);
        }
    }); 
});

//$(document).ajaxComplete(function(){
    $('.select-starships').select2();
    $('.select-starships').css({"height":"38px","width":"100px","border-radius":"0px 3px 3px 0px","border":"1px solid #ced4da"});
    $('.select-starships').select2({
    placeholder: "Buscar y seleccionar - Starship ",
    allowClear: true
    });
    $('.select-vehicles').select2();
    $('.select-vehicles').css({"height":"38px","width":"100px","border-radius":"0px 3px 3px 0px","border":"1px solid #ced4da"});
    $('.select-vehicles').select2({
    placeholder: "Buscar y seleccionar - Vehicle ",
    allowClear: true
    });

    // Starships
    $('.select-starships').on('change',function(){
        var selected = $('.select-starships :selected').text();
        if (selected!='') {
            //$('.icons-starships').show();
            $('.select-vehicles').val('').trigger('change');
            form_data = new FormData();
            form_data.append('query','querySelected');
            form_data.append('search',selected);
            form_data.append('table','starships');
            $.ajax({
                url:'dbconnect/getValues.php',
                dataType: 'json',
                data:form_data,
                contentType: false,
                processData: false,
                type: 'post',
                success: function (response) {
                $('.title-resource-reports').html(selected);
                $('.total-records-text').html('Total registros: '+response.total);
                $('.tbl-body-reports').empty();
                $('.tbl-body-reports').append(response.data);
                },
                error: function (response) {
                }
            });
        } else { $('.icons-starships').hide(); }
    });

    // Vehicles
    $('.select-vehicles').on('change',function(){
        var selected = $('.select-vehicles :selected').text();
        if (selected!='') {
            //$('.icons-vehicles').show();
            $('.select-starships').val('').trigger('change');
            form_data = new FormData();
            form_data.append('query','querySelected');
            form_data.append('search',selected);
            form_data.append('table','vehicles');
            $.ajax({
                url:'dbconnect/getValues.php',
                dataType: 'json',
                data:form_data,
                contentType: false,
                processData: false,
                type: 'post',
                success: function (response) {
                $('.title-resource-reports').html(selected);
                $('.total-records-text').html('Total registros: '+response.total);
                $('.tbl-body-reports').empty();
                $('.tbl-body-reports').append(response.data);
                },
                error: function (response) {
                }
            });
        } else { $('.icons-vehicles').hide(); }
    });
//});

// Refresh table
let refreshTableResponse = (table,selected) => {
    let text = '';
    form_data = new FormData();
    form_data.append('query','querySelected');
    form_data.append('search',selected);
    form_data.append('table',table);
    $.ajax({
        url:'dbconnect/getValues.php',
        dataType: 'json',
        data:form_data,
        contentType: false,
        processData: false,
        type: 'post',
        success: function (response) {
        $('.title-resource-reports').html(selected);
        $('.total-records-text').html('Total records: '+response.total);
        $('.tbl-body-reports').empty();
        $('.tbl-body-reports').append(response.data);
        if (table=='starships') {
            $('.totalRegsStarships').text('');
            $('.totalRegsStarships').text('Total Starships: '+response.total_rows);
        }
        if (table=='vehicles') {
            $('.totalRegsVehicles').text('');
            $('.totalRegsVehicles').text('Total Vehicles: '+response.total_rows);
        }
        },
        error: function (response) {
        }
    });
}

// Duplicar Registro
let duplicateRow = (val) => {
    if (confirm('Seguro de duplicar este registro?')) {
    $('.messg-resp').show().html('Duplicando..');
    let datas = val.split('-');
    form_data = new FormData();
    form_data.append('duplicarReg','copy');
    form_data.append('table',datas[0]);
    form_data.append('idR',datas[1]);
    $.ajax({
        url:'dbconnect/getValues.php',
        dataType: 'json',
        data:form_data,
        contentType: false,
        processData: false,
        type: 'post',
        success: function (response) {
            refreshTableResponse(datas[0],$('.title-resource-reports').text());
            $('.messg-resp').removeClass('alert-info');
            $('.messg-resp').show().addClass('alert-success').html('Registro duplicado con éxito, se ha incrementado: ' + $('.title-resource-reports').text());
            setTimeout(function(){
                $('.alert').hide();
            },2000);
        },
        error: function (response) {
        }
    });
    } else { return false}
}

// Elim Registro
let deleteRow = (val) => {
    if (confirm('Seguro de eiminar este registro?')) {
    let datas = val.split('-');
    let text = '';
    form_data = new FormData();
    form_data.append('deleteReg','delete');
    form_data.append('table',datas[0]);
    form_data.append('idR',datas[1]);
    $.ajax({
        url:'dbconnect/getValues.php',
        dataType: 'json',
        data:form_data,
        contentType: false,
        processData: false,
        type: 'post',
        success: function (response) {
            refreshTableResponse(datas[0],$('.title-resource-reports').text());
            $('.messg-resp').removeClass('alert-info');
            $('.messg-resp').removeClass('alert-success');
            $('.messg-resp').show().addClass('alert-success').html('Se ha eliminado el registro con éxito');
            setTimeout(function(){
                $('.alert').hide();
            },2000);
        },
        error: function (response) {
        }
    });
    } else { return false}
}