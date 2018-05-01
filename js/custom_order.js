/**
 * Created by Serg on 27.04.2018.
 */

$(function(){
   /*Init NP when click on link*/
    $('div#opc_checkout').on('click','label[for="id_carrier1300"]', function(){
        prepare_content();
        init_np();
    });
    //Init NP when click on button Order
    $('#pay').on('click',function(){
        /*Open order-section*/
        $('div#order-section').fadeIn('1000');
        prepare_content();
        init_np();
    });
    /*Department*/
    $('div#opc_checkout').on('change','#new_post_city', function(){
        var ref = $("#new_post_city option:selected").attr('data-ref');
        var city = $("#new_post_city option:selected").text;
        $("#new_post_department").find('option').remove();
        var data = {
            "modelName": "AddressGeneral",
            "calledMethod": "getWarehouses",
            "methodProperties": {
                "CityName": city,
                "CityRef": ref
            },
            "apiKey": "43d0a135b86d9ee3624351e1c8caf817"
        };
        $.ajax({
            url: 'https://api.novaposhta.ua/v2.0/json/?' + $.param(data),
            method: "POST",
            data : data,
            contentType:"application/json",
            dataType : "jsonp",
            success: function(data) {
                console.log('Города',data);
                var departments = data.data;

                departments.forEach(function(item){
                    var departmentName;
                    switch ('{$lang_iso}') {
                        case 'ru':
                            var departmentName = item.DescriptionRu;
                            break;

                        case 'uk':
                            var departmentName = item.Description;
                            break;

                        default:
                            var departmentName = item.DescriptionRu;
                            break;
                    }

                    console.log('Ответ', item);
                    $('#new_post_department').append('<option data-ref="' + item.Ref +'">' + departmentName   + '</option>')
                });
            },
            error: function(respons) {
                console.log(respons.success);
            }
        },'json');
    });

    /*Send info about city and department post*/
    $('#order_button').on('click', function(){
        //alert('123');
        //setTimeout(1000);
        //var city  = $('#select2-new_post_city-container').text();
        //$('#city').val(city);
        //var address = $('select2-new_post_department-container').text();
        //if($('#address1').val() === ''){
        //    $('#address1').val(address);
        //}

        //
        //var city = $('#select2-new_post_city-container,#select2-intime_post_city-container').text();
        //console.info('Город на адмынку===>', city);
        //if(city === 'Выберите город'){
        //    city = 'не указан'
        //}
        //console.info('Город на адмынку===>', city);
        //var department = $('#select2-new_post_department-container,#select2-intime_post_department-container').text();
        //console.info('Отделение на адмынку===>', department);
        //if(department === 'Выберите отделение' || department === 'Адрес отделения'){
        //    department = 'не указан'
        //}
        //console.info('Отделение на адмынку===>', department);
        //var message = $('textarea#message').val('Город доставки - ' + city  + " Отделение доставки(адрес) - " + department);
        //$('textarea#message').trigger('blur');
        //console.info(message);
    });
    $('.my-checkout').on('click', function(e){
        $('.order-button-block-top').fadeOut('100');
        $('.buy-block-cart').fadeIn('1000');
        $.scrollTo('.order-button-block-top', 1000);
        e.preventDefault();
    });

    $('.back-to-cart').on('click', function(e){
        $('.buy-block-cart').fadeOut('500');
        $.scrollTo('#content', 500);
        $('.order-button-block-top').fadeIn('1000');
        e.preventDefault();
    });

});
/*Init NP*/
function init_np(){
    //prepare_content();
    var params = {
        "modelName": "Address",
        "calledMethod": "getCities",
        "apiKey": "43d0a135b86d9ee3624351e1c8caf817"
    };

    var addingNewPostCityIteration = 0;

    var addNewPostCities = function(content){
        //console.info('FUNC >> addNewPostCities', arguments);
        //console.info('addingNewPostCityIteration =', addingNewPostCityIteration);

        if(addingNewPostCityIteration > 10){
            alert('Ошибка получения списка городов Новой Почты. Повторите попытку позже.');
            return;
        }

        addingNewPostCityIteration++;

        if($('#new_post_city').length){
            content.forEach(function(item) {
                var city;
                switch ('{$lang_iso}') {
                    case 'ru':
                        var city = item.DescriptionRu;
                        break;

                    case 'uk':
                        var city = item.Description;
                        break;

                    default:
                        var city = item.DescriptionRu;
                        break;
                }
                $('#new_post_city').append('<option data-ref="' + item.Ref + '">' + city + '</option>');
            });
            addingNewPostCityIteration = 0;
        }else{
            setTimeout(function(){
                addNewPostCities(content)
            }, 1000);
        }
    };
    $.ajax({
        url: 'https://api.novaposhta.ua/v2.0/json/?' + $.param(params),
        method: "POST",
        data : params,
        contentType:"application/json",
        dataType : "jsonp",
        success: function(data) {
            //console.log(content);
            var content = data.data;
            var object = {};
            //console.log(content);
            content.forEach(function(item,i){
                object[i] = {
                    'ua': item.Description,
                    'ru': item.DescriptionRu
                };

            });
            //console.log(object);
            var cities = JSON.stringify(object);
            //console.log(cities);

            addNewPostCities(content);

        },
        error: function(respons) {
            console.log(respons.success);
        }
    },'json');

}
function prepare_content(){
    //$('p#city_section').hide();
    //$('p#address_section').hide();
}


