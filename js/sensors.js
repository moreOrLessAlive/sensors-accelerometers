// var schemFile;
var imagesFile;

var DayNight;

$(document).ready(function() {
    $.ajax({
        url: 'php/authorization.php',
        type: 'POST',
        data: {key: 3},
        dataType: 'json'
    }).done(function(data){
        if(data.DayNight == 0){ // Выбор темы
            $('#myonoffswitch').removeAttr('checked')
            $('head').append('<link rel="stylesheet" type="text/css" href="css/sensorsNight.css">');
            DayNight = 0;
        }
        else{
            $('#myonoffswitch').attr('checked','checked')
            $('head').append('<link rel="stylesheet" type="text/css" href="css/sensors.css">');
            DayNight = 1;
        }
        if(data.errorKey == 0) { // Проверка на логин
            $('.authorization').html(
                '<table>\n' +
                '            <tr>\n' +
                '                <td>' + data.userSurname + '</td>\n' +
                '            </tr>\n' +
                '            <tr>\n' +
                '                <td>' + data.userName + '</td>\n' +
                '            </tr>\n' +
                '            <tr>\n' +
                '                <td>' + data.userPatronymic + '</td>\n' +
                '            </tr>\n' +
                '            <tr>\n' +
                '                <td><a onclick="authorization(5)">Выход</a></td>\n' +
                '            </tr>\n' +
                '        </table>'
            )
        }
        switch (data.userStatus) {
            case 0:
                $('.sensorVal').attr('disabled',true)
                $('.sensor-btn').attr('disabled',true)
                break;
            case 1:
                break;
            case 2:
                break;
            case 3:
                break;
        }
        if(data.userStatus){ // Проверка на уровень доступа
        }
    }).fail(function(){
        alert("Ошибка отправки данных")
    });

    $('#myonoffswitch').on('click', function (e) {
        switch (DayNight) {
            case 0:
                $('head').append('<link rel="stylesheet" type="text/css" href="css/sensors.css">');
                DayNight = 1;
                break;
            case 1:
                $('head').append('<link rel="stylesheet" type="text/css" href="css/sensorsNight.css">');
                DayNight = 0;
                break;
        }
        $.ajax({
            url: 'php/authorization.php',
            type: 'POST',
            data: {
                key: 4,
                DayNight: DayNight
            },
            dataType: 'json'
        }).done(function(data){
        }).fail(function(){
            alert("Ошибка отправки данных")
        });
    })

    table = $('#mainDataTable').dataTable({
        "language":{
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Russian.json"
        },
        "ajax":{
            url:"php/dataTablesSensors.php",
            type:"post"
        },
        "columnDefs":[
            {"className": "dt-center", "targets": "_all"}
        ],
        "columns":[
            null, // Название
            null, // Погрешность
            null, // Диапазон измерений
            null, // Ресурс
            null, // Вес
            null, // Габариты
            null, // Способ измерения
            {"orderable": false} // Действие
        ],
        // "aoColumns":
        //     [
        //         {"sType": "string"},
        //         {"sType": "bandwidth"},
        //         {"sType": "number"},
        //         {"sType": "string"},
        //         {"sType": "string"},
        //         {"sType": "string"}
        //     ],
        "aaSorting": [],
        "bSortCellsTop": true,
        "iDisplayLength": 10,
        "paging":   true, //Turn off paging, all records on one page
        "ordering": true, //Turn off ordering of records
        "info":     false  //Turn off table information
    });

    $("#content-slider").lightSlider({
        item:3,
        loop:true,
        keyPress:true
    });

    $(document).on('click','#newSensor',function(e) {
        e.preventDefault();
        $('#sensor-div').show();
        $('#producer-div').hide();
        $('#literature-div').hide();
        $('#editSensorButton').hide();
        $('#saveNewSensorButton').show();
        $('.menu').removeClass('menu_active');
        $('.menu-btn').removeClass('menu-btn_active');
        $('.sensorVal').val("")
        $('.sensor_info').toggleClass('sensor_info_active');
        $('.authorization').removeClass('authorization_active');
    });

    $(document).on('click','#producerEdit',function(e) {
        e.preventDefault();
        $('#sensor-div').hide();
        $('#producer-div').show();
        $('#literature-div').hide();
        $('#editSensorButton').hide();
        $('#saveNewSensorButton').show();
        $('.menu').removeClass('menu_active');
        $('.menu-btn').removeClass('menu-btn_active');
        $('.sensorVal').val("")
        $('.sensor_info').toggleClass('sensor_info_active');
        $('.authorization').removeClass('authorization_active');
        $.ajax({
            url: 'php/producer_info.php',
            type: 'POST',
            dataType: 'html'
        }).done(function(data){
            $('#producer-div').html(data)
        }).fail(function(){
            alert("Ошибка отправки данных")
        });
    });

    $(document).on('click','#literatureEdit',function(e) {
        e.preventDefault();
        $('#sensor-div').hide();
        $('#producer-div').hide();
        $('#literature-div').show();
        $('#editSensorButton').hide();
        $('#saveNewSensorButton').show();
        $('.menu').removeClass('menu_active');
        $('.menu-btn').removeClass('menu-btn_active');
        $('.sensorVal').val("")
        $('.sensor_info').toggleClass('sensor_info_active');
        $.ajax({
            url: 'php/literature_info.php',
            type: 'POST',
            dataType: 'html'
        }).done(function(data){
            $('#literature-div').html(data)
            console.log($('#select_literature').val())
        }).fail(function(){
            alert("Ошибка отправки данных")
        });
    });

    $(document).on('click','#getEdit',function(e){
        e.preventDefault();
        $('#sensor-div').show();
        $('#producer-div').hide();
        $('#literature-div').hide();
        $('#editSensorButton').show();
        $('#saveNewSensorButton').hide();
        $('.menu').removeClass('menu_active');
        $('.menu-btn').removeClass('menu-btn_active');
        var per_id = $(this).data('id');
        $('#content-data').html('');
        $.ajax({
            url:'php/sensorsEdit.php',
            type:'POST',
            data:'ID='+per_id,
            dataType:'json'
        }).done(function(data){
            $("#ID").val(data.ID)
            $("#title").val(data.title)
            $("#producer").val(data.producer)
            $("#resource_h").val(data.resource_h)
            $("#sensitive_element").val(data.sensitive_element)
            $("#weight_g").val(data.weight_g)
            $("#infelicity_percent").val(data.infelicity_percent)
            $("#lower_temperature_threshold_c").val(data.lower_temperature_threshold_c)
            $("#upper_temperature_threshold_c").val(data.upper_temperature_threshold_c)
            $("#lower_measurement_range").val(data.lower_measurement_range)
            $("#upper_measurement_range").val(data.upper_measurement_range)
            $("#unit_of_measurement").val(data.unit_of_measurement)
            $("#length_mm").val(data.length_mm)
            $("#width_mm").val(data.width_mm)
            $("#height_mm").val(data.height_mm)
            $("#electric_circuit").attr("src", data.electric_circuit);
            $('.sensor_info').toggleClass('sensor_info_active');
            // $('.content').toggleClass('content_active');
        }).fail(function(){
            alert("Ошибка отправки данных")
            // $('#content-data').html('<p>Error</p>');
        });
    });

    $(document).on('click','#getDelete',function(e){
        if(confirm("Вы уверены?")) {
            e.preventDefault();
            var per_id = $(this).data('id');
            $.ajax({
                url: 'php/sensorsDelete.php',
                type: 'POST',
                data:'ID='+per_id,
                dataType: 'json'
            }).done(function (data) {
                $('#mainDataTable').DataTable().ajax.reload();
                console.log(data)
            }).fail(function (data) {
                alert("Ошибка отправки данных")
                console.log(data)
            });
        }
    });

    // $('.menu-btn').on('click', function(e) {
    $('.menu-btn').on('click', function(e) {
        e.preventDefault();
        $('.menu').toggleClass('menu_active');
        $('.menu-btn').toggleClass('menu-btn_active');
        $('.content').toggleClass('content_active');
    })

    $('.sensor_info-btn').on('click', function(e) {
        e.preventDefault();
        $('.sensor_info').toggleClass('sensor_info_active');
    })

    $('.producer_info-btn').on('click', function(e) {
        e.preventDefault();
        $('.producer_info').toggleClass('producer_info_active');
    })

    $('#saveNewSensorButton').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url:'php/saveNewSensor.php',
            type:'POST',
            data:'title='+$("#title").val()
                +'&producer='+$("#producer").val()
                +'&resource_h='+$("#resource_h").val()
                +'&sensitive_element='+$("#sensitive_element").val()
                +'&weight_g='+$("#weight_g").val()
                +'&infelicity_percent='+$("#infelicity_percent").val()
                +'&lower_temperature_threshold_c='+$("#lower_temperature_threshold_c").val()
                +'&upper_temperature_threshold_c='+$("#upper_temperature_threshold_c").val()
                +'&lower_measurement_range='+$("#lower_measurement_range").val()
                +'&upper_measurement_range='+$("#upper_measurement_range").val()
                +'&unit_of_measurement='+$("#unit_of_measurement").val()
                +'&length_mm='+$("#length_mm").val()
                +'&width_mm='+$("#width_mm").val()
                +'&height_mm='+$("#height_mm").val(),
            dataType:'json'
        }).done(function(data) {
            $('#mainDataTable').DataTable().ajax.reload();
            console.log(data)
            $('.sensor_info').toggleClass('sensor_info_active');
        }).fail(function(data){
            alert("Ошибка отправки данных")
            console.log(data)
        });
    })

    $('#editSensorButton').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            url:'php/editSensor.php',
            type:'POST',
            // data:'ID='+$("#ID").val()
            //     +'&title='+$("#title").val()
            //     +'&producer='+$("#producer").val()
            //     +'&resource_h='+$("#resource_h").val()
            //     +'&sensitive_element='+$("#sensitive_element").val()
            //     +'&weight_g='+$("#weight_g").val()
            //     +'&infelicity_percent='+$("#infelicity_percent").val()
            //     +'&lower_temperature_threshold_c='+$("#lower_temperature_threshold_c").val()
            //     +'&upper_temperature_threshold_c='+$("#upper_temperature_threshold_c").val()
            //     +'&lower_measurement_range='+$("#lower_measurement_range").val()
            //     +'&upper_measurement_range='+$("#upper_measurement_range").val()
            //     +'&unit_of_measurement='+$("#unit_of_measurement").val()
            //     +'&length_mm='+$("#length_mm").val()
            //     +'&width_mm='+$("#width_mm").val()
            //     +'&height_mm='+$("#height_mm").val(),
            data:{
                ID: $("#ID").val(),
                title: $("#title").val(),
                producer: $("#producer").val(),
                resource_h: $("#resource_h").val(),
                sensitive_element: $("#sensitive_element").val(),
                weight_g: $("#weight_g").val(),
                infelicity_percent: $("#infelicity_percent").val(),
                lower_temperature_threshold_c: $("#lower_temperature_threshold_c").val(),
                upper_temperature_threshold_c: $("#upper_temperature_threshold_c").val(),
                lower_measurement_range: $("#lower_measurement_range").val(),
                upper_measurement_range: $("#upper_measurement_range").val(),
                unit_of_measurement: $("#unit_of_measurement").val(),
                length_mm: $("#length_mm").val(),
                width_mm: $("#width_mm").val(),
                height_mm: $("#height_mm").val()
            },
            dataType:'json'
        }).done(function(data) {
            $('#mainDataTable').DataTable().ajax.reload();
            console.log(data)
            $('.sensor_info').toggleClass('sensor_info_active');
        }).fail(function(data){
            alert("Ошибка отправки данных")
            console.log(data)
        });
    })

    $('#scheme-inp').change(function () {
        let file = this.files[0];
        let reader = new FileReader();
        reader.onload = function() {
            $("#electric_circuit").attr("src", reader.result);
        };
        reader.readAsDataURL(file);
        reader.onerror = function() {
            console.log(reader.error);
        };

        var file_data = $('#scheme-inp').prop('files')[0];
        var form_data = new FormData();
        form_data.append('key', 1);
        form_data.append('ID', $('#ID').val());
        form_data.append('file', file_data);

        $.ajax({
            url:'php/uploadImages.php',
            type:'POST',
            cache: false,
            data: form_data,
            // data:{
            //     key: 1,
            //     ID: $('#ID').val(),
            //     filesImg: file
            // },
            dataType:'json',
            processData: false, // Не обрабатываем файлы (Don't process the files)
            contentType: false, // Так jQuery скажет серверу что это строковой запрос
        }).done(function(data) {
            // $("#electric_circuit").attr("src", data.electric_circuit);
            console.log(data)
        }).fail(function(data){
            alert("Ошибка отправки данных")
            console.log(data)
        });
    })

    $(document).on('mouseover','#authorization',function(e) {
        e.preventDefault();
        $('.authorization').toggleClass('authorization_active');
        $.ajax({
            url: 'php/authorizationForm.php',
            type: 'POST',
            dataType: 'html'
            }).done(function(data){
                // $('.authorization').html(data)
            }).fail(function(){
                alert("Ошибка отправки данных")
            });
    });

    $('#registration').on('click', function (e) {
        e.preventDefault();
        $('.registration').toggleClass('registration_active');
        $('.authorization').removeClass('authorization_active');
    })
    $('.registration_close-btn').on('click', function (e) {
        e.preventDefault();
        $('.registration').toggleClass('registration_active');
    })
    $('.authorization').mouseleave(function () {
        $('.authorization').removeClass('authorization_active');
    })

    $('#electric_circuit').on('click', function (e) {
        $('#Modal').css('display', 'block')
        $('.modal-image').attr('src',$('#electric_circuit').attr('src'))
    })
    $('.modal-close').on('click', function (e) {
        $('#Modal').css('display', 'none')
    })
    $('.modal').on('click', function (e) {
        $('#Modal').css('display', 'none')
    })
});

function selectProducer(switchKey){
    if ($("#select_producer").val() == 0){
        // $("#producer-btn").prop('value', 'Сохранить');
        $("#producer-btn").html('Сохранить');
    }
    else{
        // $("#producer-btn").prop('value', 'Подтвердить изменения');
        $("#producer-btn").html('Подтвердить изменения');
    }
    $.ajax({
        url:'php/producer_info_update.php',
        type:'POST',
        data:{
            key: switchKey,
            IDproducer: $("#select_producer").val(),
            producer: $("#input_producer").val(),
            producer_info: $("#textarea_producer").val()
        },
        dataType:'json'
    }).done(function(data) {
        $('#input_producer').val(data.producer);
        $('#textarea_producer').val(data.producer_info)
        console.log(data)
        if (switchKey == 2) {
            $('.sensor_info').toggleClass('sensor_info_active');
        }
    }).fail(function(data){
        alert("Ошибка отправки данных")
        console.log(data)
    });
}

function selectLiterature(switchKey){
    if ($("#select_literature").val() == 0){
        $("#literature-btn").html('Сохранить');
    }
    else{
        $("#literature-btn").html('Подтвердить изменения');
    }
    $.ajax({
        url:'php/literature_info_update.php',
        type:'POST',
        data:{
            key: switchKey,
            IDliterature: $("#select_literature").val(),
            literature_title: $("#literature_title").val(),
            literature_author: $("#literature_author").val(),
            literature_publisher: $("#literature_publisher").val(),
            literature_year: $("#literature_year").val(),
            literature_language: $("#literature_language").val()
        },
        dataType:'json'
    }).done(function(data) {
        $('#literature_title').val(data.literature_title);
        $('#literature_author').val(data.literature_author);
        $('#literature_publisher').val(data.literature_publisher);
        $('#literature_year').val(data.literature_year);
        $('#literature_language').val(data.literature_language)
        console.log(data)
        if (switchKey == 2) {
            $('.sensor_info').toggleClass('sensor_info_active');
        }
    }).fail(function(data){
        alert("Ошибка отправки данных")
        console.log(data)
    });
}

function upload_image(switchKey, input) {
    // let file = input.files[0];
    // let reader = new FileReader();
    // reader.onload = function() {
    //     $("#electric_circuit").attr("src", reader.result);
    // };
    // reader.readAsDataURL(input.files[0]);
    // reader.onerror = function() {
    //     console.log(reader.error);
    // };

    if (switchKey == 0) {
        files = schemFile;
    }
    else{
        files = imagesFile;
    }
    $.ajax({
        url:'php/uploadImages.php',
        type:'POST',
        data:{
            key: switchKey,
            files: files
        },
        dataType:'json'
    }).done(function(data) {
        if (switchKey == 0) {
            $("#electric_circuit").attr("src", data.electric_circuit);
        }
    }).fail(function(data){
        alert("Ошибка отправки данных")
        console.log(data)
    });
}

function authorization(switchKey) {
    $.ajax({
        url:'php/authorization.php',
        type:'POST',
        data:{
            key: switchKey,
            login: $("#login").val(),
            password: $("#password").val(),
            regLogin: $("#regLogin").val(),
            regPassword: $("#regPassword").val(),
            regPasswordRepeat: $("#regPasswordRepeat").val(),
            regSurname: $("#regSurname").val(),
            regName: $("#regName").val(),
            regPatronymic: $("#regPatronymic").val(),
            Email: $("#Email").val(),
        },
        dataType:'json'
        }).done(function(data) {
            if(data.errorKey == 0){
                location.reload();
                console.log(data.data)
            }
            else{
                alert(data.data)
            }
            // console.log(data)
            // switch (switchKey) {
            //     case 1:
            //         if(data.errorKey == 0){
            //             location.reload();
            //         }
            //         else{
            //             alert(data.data)
            //         }
            //         break;
            //     case 2:
            //         if(data.errorKey == 0){
            //             location.reload();
            //         }
            //         else{
            //             alert(data.data)
            //         }
            //         break;
            // }
        }).fail(function(data){
            alert("Ошибка отправки данных")
            console.log(data)
        });
}