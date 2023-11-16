//filter search js

    // Show the first tab and hide the rest
    $('#tabs-nav li:first-child').addClass('active');
    $('.tab-content').hide();
    $('.tab-content:first').show();

    // Click function
    $('#tabs-nav li').click(function(){
    $('#tabs-nav li').removeClass('active');
    $(this).addClass('active');
    $('.tab-content').hide();
    
    var activeTab = $(this).find('a').attr('href');
    $(activeTab).fadeIn();
    return false;
    });

    
	new TomSelect("#select-tags",{
		plugins: ['remove_button'],
		render:{
			option:function(data,escape){
				return '<div class="d-flex"><span>' + escape(data.text) + '</span><span class="ms-auto text-muted">' + '' + '</span></div>';
			},
			item:function(data,escape){
				return '<div>' + escape(data.text) + '</div>';
			}
		}
    });
    new TomSelect('.min-check');
    new TomSelect('.max-check');
    new TomSelect('.min-year');
    new TomSelect('.max-year');
    new TomSelect('.min-price');
    new TomSelect('.max-price');


	
 

$('#filterBtn').click(function () {

        if ($('#buy_car').is(':checked')) {
            $('#filterForm').attr('action', 'buy/post/');
        }
        else if ($('#sale_car').is(':checked')) {
            $('#filterForm').attr('action', 'sale/post/');
    }
    });


// style for multi select manufacture 
jQuery(function() {
jQuery('.multiSelect').each(function(e) {
var self = jQuery(this);
var field = self.find('.multiSelect_field');
var fieldOption = field.find('option');
var placeholder = field.attr('data-placeholder');

$('#filter_modal').click(function() {
    $('.modal').toggle();
 });
field.hide().after(`<div class="multiSelect_dropdown"></div>
                    <span class="multiSelect_placeholder">` + placeholder + `</span>
                    <ul class="multiSelect_list"></ul>
                    <span class="multiSelect_arrow"></span>`);

fieldOption.each(function(e) {
  jQuery('.multiSelect_list').append(`<li class="multiSelect_option" data-value="`+jQuery(this).val()+`">
                                        <a class="multiSelect_text">`+jQuery(this).text()+`</a>
                                      </li>`);
});

var dropdown = self.find('.multiSelect_dropdown');
var list = self.find('.multiSelect_list');
var option = self.find('.multiSelect_option');
var optionText = self.find('.multiSelect_text');

dropdown.attr('data-multiple', 'true');
list.css('top', dropdown.height() + 5);

option.click(function(e) {
  var self = jQuery(this);
  e.stopPropagation();
  self.addClass('-selected');
  field.find('option:contains(' + self.children().text() + ')').prop('selected', true);
  dropdown.append(function(e) {
    return jQuery('<span class="multiSelect_choice">'+ self.children().text() +'<i class="fa-solid fa-xmark multiSelect_deselect -iconX"><use href="#iconX"></use></i></span>').click(function(e) {
      var self = jQuery(this);
      e.stopPropagation();
      self.remove();
      list.find('.multiSelect_option:contains(' + self.text() + ')').removeClass('-selected');
      list.css('top', dropdown.height() + 5).find('.multiSelect_noselections').remove();
      field.find('option:contains(' + self.text() + ')').prop('selected', false);
      if (dropdown.children(':visible').length === 0) {
        dropdown.removeClass('-hasValue');
      }
    });
  }).addClass('-hasValue');
  list.css('top', dropdown.height() + 5);
  if (!option.not('.-selected').length) {
    list.append('<h5 class="multiSelect_noselections">No Selections</h5>');
  }
});

dropdown.click(function(e) {
  e.stopPropagation();
  e.preventDefault();
  dropdown.toggleClass('-open');
  list.toggleClass('-open').scrollTop(0).css('top', dropdown.height() + 5);
});

jQuery(document).on('click touch', function(e) {
    if (dropdown.hasClass('-open')) {
        dropdown.toggleClass('-open');
        list.removeClass('-open');
    }
});
});
});


$(".max-year").on('change', function() {

    var current = $(this).val();
    var inputs = $(this).parent("div").siblings("div").find(".min-year").find(":selected").val();

    $('#select-maxYear').remove();


    if (parseInt(current) < parseInt(inputs)) {

        $('.min-year .item').attr('data-value', 'Select Year');
        //$('.min-year').attr('value', 'null');
        $('.min-year').val("null");
        $('.min-year .item').text('Select Year');
    
    }

});

$(".min-year").on('change', function () {

    var current = $(this).val();
    var inputs = $(this).parent("div").siblings("div").find(".max-year").find(":selected").val();

    $('#select-minYear').remove();

    if (parseInt(current) > parseInt(inputs)) {

        $('.max-year .item').attr('data-value', 'Select Year');
        $('.max-year').val("null");
        $('.max-year .item').text('Select Year');
    
    }

});
$(".min-year .ts-dropdown-content").click(function () {

    var texttemp = $(this).children('.selected').text();
    var clickedoption = $(this).find(".active").text();
    $('.min-year').val(parseInt(clickedoption));
    if ($(".min-year .item").text() == "") {

        $('.min-year .item').attr('data-value', texttemp);
        $(".min-year .item").text(texttemp);
        $(".min-year .item").val(texttemp);

        var current = $('.min-year').val();
        var inputs = $('.min-year').parent("div").siblings("div").find(".max-year").find(":selected").val();

         if (parseInt(clickedoption) == parseInt(texttemp))  {

            if (parseInt(current) > parseInt(inputs)) {

                $('.max-year').val('null');
                $('.max-year .item').attr('data-value', 'Select Year');
                $('.max-year .item').text('Select Year');
            } else if (current == null) {

                $('.max-year').val('null');
                $('.max-year .item').attr('data-value', 'Select Year');
                $('.max-year .item').text('Select Year');                
            }
        }

    }
});

$(".max-year .ts-dropdown-content").click(function () {

    var texttemp = $(this).children('.selected').text();
    var clickedoption = $(this).find(".active").text();
    $('.max-year').val(parseInt(clickedoption));
    
    if ($(".max-year .item").text() == "") {
        
        $('.max-year .item').attr('data-value', texttemp);
        $(".max-year .item").text(texttemp);
        $(".max-year .item").val(texttemp);

        var current = $('.max-year').val();
        var inputs = $('.max-year').parent("div").siblings("div").find(".min-year").find(":selected").val();

         if (parseInt(clickedoption) == parseInt(texttemp))  {

            if (parseInt(current) < parseInt(inputs)) {

                $('.min-year').val('null');
                $('.min-year .item').attr('data-value', 'Select Year');
                $('.min-year .item').text('Select Year');
            } else if (current == null) {

                $('.min-year').val('null');
                $('.min-year .item').attr('data-value', 'Select Year');
                $('.min-year .item').text('Select Year');                
            }
        }
    }
});

$(".min-price .ts-dropdown-content").click(function () {

    var texttemp = $(this).children('.selected').text();
    var clickedoption = $(this).find(".active").text();
    $('.min-price').val(parseInt(clickedoption));

    if ($(".min-price .item").text() == "") {

        $('.min-price .item').attr('data-value', texttemp);
        $(".min-price .item").text(texttemp);
        $(".min-price .item").val(texttemp);
    }

    var current = $('.min-price').val();
    var inputs = $('.min-price').parent("div").siblings("div").find(".max-price").find(":selected").val();

    if (parseInt(clickedoption) == parseInt(texttemp))  {
        if (parseInt(current) > parseInt(inputs)) {
            $('.max-price').val('null');
            $('.max-price .item').attr('data-value', 'Select Price');
            $('.max-price .item').text('Select Price');
        } else if (current == null) {

            $('.max-price').val('null');
            $('.max-price .item').attr('data-value', 'Select Price');
            $('.max-price .item').text('Select Price');                
        }
    }

    
});

$(".max-price .ts-dropdown-content").click(function () {

    var texttemp = $(this).children('.selected').text();
    var clickedoption = $(this).find(".active").text();
    $('.max-price').val(parseInt(clickedoption));

    if ($(".max-price .item").text() == "") {
        $('.max-price .item').attr('data-value', texttemp);
        $(".max-price .item").text(texttemp);
        $(".max-price .item").val(texttemp);
    }
    var current = $('.max-price').val();
    var inputs = $('.max-price').parent("div").siblings("div").find(".min-price").find(":selected").val();

    if (parseInt(clickedoption) == parseInt(texttemp))  {
        if (parseInt(current) < parseInt(inputs)) {

            $('.min-price').val('null');
            $('.min-price .item').attr('data-value', 'Select Price');
            $('.min-price .item').text('Select Price');
        } else if (current == null) {

            $('.min-price').val('null');
            $('.min-price .item').attr('data-value', 'Select Price');
            $('.min-price .item').text('Select Price');                
        }
    }

    
});

$(".min-check .ts-dropdown-content").click(function () {

    //$(this).find(":selected").css("background-color", "red");
    var texttemp = $(this).children('.selected').text();
    var clickedoption = $(this).find(".active").text();
    $('.min-check').val(parseInt(clickedoption));

    if ($(".min-check .item").text() == "") {

        $('.min-check .item').attr('data-value', texttemp);
        $(".min-check .item").text(texttemp);
        $(".min-check .item").val(texttemp);
    }

    var current = $('.min-check').val();
    var inputs = $('.min-check').parent("div").siblings("div").find(".max-check").find(":selected").val();

    if (parseInt(clickedoption) == parseInt(texttemp))  {
        if (parseInt(current) > parseInt(inputs)) {
            $('.max-check .item').attr('data-value', 'Select Km');
            $('.max-check .item').text('Select Km');
        } else if (current == null) {

            $('.max-check').val('null');
            $('.max-check .item').attr('data-value', 'Select Km');
            $('.max-check .item').text('Select Km');                
        }
    }

    
});

$(".max-check .ts-dropdown-content").click(function () {

    //$(this).find(":selected").css("background-color", "red");
    var texttemp = $(this).children('.selected').text();
    var clickedoption = $(this).find(".active").text();
    $('.max-check').val(parseInt(clickedoption));
    

    if ($(".max-check .item").text() == "") {
        $('.max-check .item').attr('data-value', texttemp);
        $(".max-check .item").text(texttemp);
        $(".max-check .item").val(texttemp);
    }
    var current = $('.max-check').val();
    var inputs = $('.max-check').parent("div").siblings("div").find(".min-check").find(":selected").val();

    if (parseInt(clickedoption) == parseInt(texttemp))  {
        if (parseInt(current) < parseInt(inputs)) {
            $('.min-check .item').attr('data-value', 'Select Km');
            $('.min-check .item').text('Select Km');
        } else if (current == null) {

            $('.min-check').val('null');
            $('.min-check .item').attr('data-value', 'Select Km');
            $('.min-check .item').text('Select Km');           
        }
    }

    
});

$(".min-year .ts-control").click(function () {
    if ($(".max-year .item").text() == "")
    {

        $(".max-year input").before("<div class='item' id='select-maxYear'>Select Year</div>");
    }
    if ($(".min-year .item").text() == "")
    {
        $(".min-year input").before("<div class='item' id='select-minYear'>Select Year</div>");

    }  else {
        
        var temp = $(".min-year .item").text();

        if (temp == 'Select Year')
        {
            $(".min-year .item").text("")
        } else {
        $(".min-year .item").text(temp);

        }

          $('#select-minYear').remove();
    }
    
});
$(".max-year .ts-control").click(function () {

    if ($(".min-year .item").text() == "")
    {
        $(".min-year input").before("<div class='item' id='select-minYear'>Select Year</div>");
    }
    if ($(".max-year .item").text() == "")
    {
        $(".max-year input").before("<div class='item' id='select-maxYear'>Select Year</div>");
    } else {
        var temp = $(".max-year .item").text();

        if (temp == "Select Year")
        {
            $(".max-year .item").text("");
        } else {
            $(".max-year .item").text(temp);

        }
       $('#select-maxYear').remove();
    }
});


//////////////////////////////
$(".max-price").on('change', function() {

    var current = $(this).val();
    var inputs = $(this).parent("div").siblings("div").find(".min-price").find(":selected").val();

    $('#select-maxPrice').remove();

    if (parseInt(current) < parseInt(inputs)) {


        $('.min-price .item').attr('data-value', 'Select Price');
        $('.min-price').val("null")
        $('.min-price .item').text('Select Price');   
    }

});

$(".min-price").on('change', function () {



    var current = $(this).val();
    var inputs = $(this).parent("div").siblings("div").find(".max-price").find(":selected").val();

    $('#select-minPrice').remove();

    if (parseInt(current) > parseInt(inputs)) {
 
        $('.max-price .item').attr('data-value', 'Select Price');
        $('.max-price').val("null")
        $('.max-price .item').text('Select Price');    
    }

});

$(".min-price .ts-control").click(function () {

    if ($(".max-price .item").text() == "")
    {

        $(".max-price input").before("<div class='item' id='select-maxPrice'>Select Price</div>");
    }
    if ($(".min-price .item").text() == "")
    {
        $(".min-price input").before("<div class='item' id='select-minPrice'>Select Price</div>");

    }  else {
        
        var temp = $(".min-price .item").text();

        if (temp == 'Select Price')
        {
            $(".min-price .item").text("")
        } else {
        $(".min-price .item").text(temp);
        
        }

        $('#select-minPrice').remove();
    }
});
$(".max-price .ts-control").click(function () {


    if ($(".min-price .item").text() == "")
    {
        $(".min-price input").before("<div class='item' id='select-minPrice'>Select Price</div>");
    }
    if ($(".max-price .item").text() == "")
    {
        $(".max-price input").before("<div class='item' id='select-maxPrice'>Select Price</div>");
    } else {
        var temp = $(".max-price .item").text();

        if (temp == "Select Price")
        {
            $(".max-price .item").text("");
        } else {
            $(".max-price .item").text(temp);
        }
        $('#select-maxPrice').remove();
    }
});


///////////////////////////////

$(".min-check .ts-control").click(function () {

    if ($(".max-check .item").text() == "")
    {

        $(".max-check input").before("<div class='item' id='select-maxCheck'>Select Km</div>");
    }
    if ($(".min-check .item").text() == "")
    {
        $(".min-check input").before("<div class='item' id='select-minCheck'>Select Km</div>");

    }  else {
        
        var temp = $(".min-check .item").text();

        if (temp == 'Select Km')
        {
            $(".min-check .item").text("")
        } else {
        $(".min-check .item").text(temp);
        
        }

        $('#select-minCheck').remove();
    }
    
});
$(".max-check .ts-control").click(function () {

    if ($(".min-check .item").text() == "")
    {
        $(".min-check input").before("<div class='item' id='select-minCheck'>Select Km</div>");
    }
    if ($(".max-check .item").text() == "")
    {
        $(".max-check input").before("<div class='item' id='select-maxCheck'>Select Km</div>");
    } else {
        var temp = $(".max-check .item").text();

        if (temp == "Select Km")
        {
            $(".max-check .item").text("");
        } else {
            $(".max-check .item").text(temp);
        }
        $('#select-maxCheck').remove();
    }
    
});
    $(".modal-content").click(function () {
        if ($(".max-check .item").text() == "")
        {
            $(".max-check input").before("<div class='item' id='select-maxCheck'>Select Km</div>");
        }
        if ($(".min-check .item").text() == "")
        {
            $(".min-check input").before("<div class='item' id='select-minCheck'>Select Km</div>");
        }
        if ($(".max-year .item").text() == "")
        {
            $(".max-year input").before("<div class='item' id='select-maxYear'>Select Year</div>");
        }
        if ($(".min-year .item").text() == "")
        {
            $(".min-year input").before("<div class='item' id='select-minYear'>Select Year</div>");
        }
        if ($(".max-price .item").text() == "")
        {
            $(".max-price input").before("<div class='item' id='select-maxPrice'>Select Price</div>");
        }
        if ($(".min-price .item").text() == "")
        {
            $(".min-price input").before("<div class='item' id='select-minPrice'>Select Price</div>");
        }
        
    });

$(".max-check").on('change', function() {

    var current = $(this).val();
    var inputs = $(this).parent("div").siblings("div").find(".min-check").find(":selected").val();

    $('#select-maxCheck').remove();

    if (parseInt(current) < parseInt(inputs)) {
        $('.min-check .item').attr('data-value', 'Select Km');
        $('.min-check').val("null")
        $('.min-check .item').text('Select Km');    
    }

});

$(".min-check").on('change', function () {

    var current = $(this).val();
    var inputs = $(this).parent("div").siblings("div").find(".max-check").find(":selected").val();

    $('#select-minCheck').remove();

    if (parseInt(current) > parseInt(inputs)) {
        $('.max-check .item').attr('data-value', 'Select Km');
        $('.max-check').val("null")
        $('.max-check .item').text('Select Km');   
    }

});
$('.min-check').css({ "opacity": '0.5', 'pointer-events': 'none' });
$('.max-check').css({ "opacity": '0.5' , 'pointer-events' : 'none'});
$('#brandnew').click(function () {
    if($('#used').is(':checked')) {
        $('.min-check').css({ "opacity": '1', 'pointer-events': 'all' });
        $('.max-check').css({ "opacity": '1' , 'pointer-events' : 'all'});
    } else if ($('#brandnew').is(':checked')) {
        $('.min-check').css({ "opacity": '0.5', 'pointer-events': 'none' });
        $('.max-check').css({ "opacity": '0.5', 'pointer-events': 'none' });
    } else if (!$('#brandnew').is(':checked')) {
        $('.min-check').css({ "opacity": '1', 'pointer-events': 'all' });
        $('.max-check').css({ "opacity": '1' , 'pointer-events' : 'all'});
    }
    if ((!$('#brandnew').is(':checked')) && (!$('#used').is(':checked'))) {
        $('.min-check').css({ "opacity": '0.5', 'pointer-events': 'none' });
        $('.max-check').css({ "opacity": '0.5', 'pointer-events': 'none' });
        $('.max-check').prop('disabled', true);
        $('.min-check').prop('disabled', true);

    }
});
$('#used').click(function() {
if ($('#used').is(':checked')) {
        $('.min-check').css({ "opacity": '1', 'pointer-events': 'all' });
        $('.max-check').css({ "opacity": '1' , 'pointer-events' : 'all'});        
} else if ($('#brandnew').is(':checked')) {
        $('.min-check').css({ "opacity": '0.5', 'pointer-events': 'none' });
        $('.max-check').css({ "opacity": '0.5', 'pointer-events': 'none' }); 
    }
    if ((!$('#brandnew').is(':checked')) && (!$('#used').is(':checked'))) {
        $('.min-check').css({ "opacity": '0.5', 'pointer-events': 'none' });
        $('.max-check').css({ "opacity": '0.5', 'pointer-events': 'none' });
        $('.max-check').prop('disabled', true);
        $('.min-check').prop('disabled', true);
    }

});
//For deleting text in multiple manufac after selected an item
$('.ts-dropdown-content').click(function () {

    $('#select-tags-ts-control').val('');
});

//For deleting text in multiple manufac after enter selected item
$(document).ready(function () {

    $("#select-tags-ts-control").on('keyup', function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        $("#select-tags-ts-control").val('');
        $("#select-tags-ts-control").text('');
        $('#select-tags-ts-control').blur();
        $('#select-tags-ts-control').focus();
    }
});
});






