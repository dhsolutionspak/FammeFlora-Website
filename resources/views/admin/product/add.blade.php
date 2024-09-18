@extends('admin.layouts.app')

@prepend('styles')
<link href="{{ asset('frontend') }}/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endprepend
@section('content')
<div class="header bg-primary pb-1">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-black d-inline-block mb-0">Product</h6>
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{ route('product') }}">Product</a></li>
                            <li class="breadcrumb-item">Add</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</div>



<div class="container-fluid">
    <div class="align-items-center d-flex flex-wrap gap-5 justify-content-between mb-2 pb-1">
        <h4><i class="icofont-plugin"></i> Add New Product</h4>
    </div>
    <form method="post" id="data-form" action="{{ route('product.store') }}" enctype="multipart/form-data"
        autocomplete="off" class="row">
        @csrf
        @method('post')
        <div class="col-lg-7 col-md-7 col-sm-12">
            <div class="card mb-30">
                <div class="card-header bg-white border-bottom2">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4>Product Information</h4>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.product.tabs.general')
                </div>
            </div>
            <div class="card mb-30">
                <div class="card-header bg-white border-bottom2">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4>Product Options</h4>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.product.tabs.option')
                </div>
            </div>

            <div class="card mb-30">
                <div class="card-header bg-white border-bottom2">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4>Product Additional Images</h4>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.product.tabs.image')
                </div>
            </div>

            <div class="card mb-30">
                <div class="card-header bg-white border-bottom2">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4>Product Attribute</h4>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.product.tabs.attribute')
                </div>
            </div>

            <div class="card mb-30">
                <div class="card-header bg-white border-bottom2">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4>Product Seo</h4>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.product.tabs.productseo')
                </div>
            </div>

        </div>
        <div class="col-lg-5 col-md-5 col-sm-12">
            <div class="card mb-30">
                <div class="card-header bg-white border-bottom2">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4>Product Links</h4>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.product.tabs.links')
                </div>
            </div>

            <div class="card mb-30">
                <div class="card-header bg-white border-bottom2">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4>Price & Shipping</h4>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.product.tabs.data')
                </div>
            </div>

            <div class="card mb-30">
                <div class="card-header bg-white border-bottom2">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4>Product Special Discount</h4>
                    </div>
                </div>
                <div class="card-body">
                    @include('admin.product.tabs.special')
                </div>
            </div>
        </div>

        <div
            class="bottom-btn bg-white  d-flex align-items-center justify-content-sm-end gap-10 flex-wrap justify-content-center">
            <button type="submit" name="submit" value="1" class="btn btn-success" tabindex="4">
                Save Product
            </button>
        </div>

    </form>
</div>

</div>

@endsection

@push('js')

<script src="{{ asset('assets') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<!-- Select2 JS -->
<script src="{{ asset('frontend') }}/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.22.1/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.22.1/adapters/jquery.min.js"></script>

<!-- JavaScript -->
<script type="text/javascript" src="{{ asset('frontend') }}/js/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/alertify.min.css">
<!-- Default theme -->
<link href="{{ asset('frontend') }}/css/default.min.css" rel="stylesheet">

<script>
    $('.datepicker').datepicker({
            format: datePickerFormat,
            startDate: '-3d'
        });

        $('selectpicker').selectpicker();

        // Initialize select2
        $(".select2Class").select2();


        var counter = 1;
        $(document).on('click', '#addRowButton', function() {

        });

        function appendToImageTable(tableId) {
            $(`#${tableId}`).append(`<tr class="tr_clone">
            <td><input type="file" name="product_image[image][]" id=image${counter} class="form-control form-control-alternative" required></td>
            <td class="budget"> <input type="number" min="1" name="product_image[sort_order_image][]" id=sort_order_image${counter} class="form-control form-control-alternative" required autofocus></td>
            <td>
                <button class="btn btn-danger" type="button" id="DeleteButton" ><icon class="fa fa-minus" /></button>
            </td>
        </tr>`);
            counter += 1;
        }

        $("#tbl").on("click", "#DeleteButton", function() {
            $(this).closest("tr").remove();
            counter -= 1;
        });

        // Option Product
        var counter_option = 1;

        function appendToOptionTable(tableId,optionID,optionType) {

          let renderHTML = '<tr class="tr_option_clone"><td><input type="text" placeholder="Enter Label" name="option['+optionID+'][label][]" class="form-control" type="text" /></td>';
          renderHTML += '<td><input type="number"   name="option['+optionID+'][price][]" class="form-control" type="text" placeholder="Enter Price" /></td>';
          if(optionType == 'Color') {
              renderHTML += '<td><input type="text" placeholder="Enter Color Name or Code" name="option['+optionID+'][color_code][]" class="form-control" type="text" /></td>';
          }
          renderHTML += '<td><button class="btn btn-danger" type="button" type="button" id="DeleteOptionButton" ><icon class="fa fa-minus" /></button>  </td></tr>'

            $('#counter_option_tb1'+ optionID).append(renderHTML);

            counter_option += 1;

            $('.datepicker').datepicker({
                format: datePickerFormat,
                startDate: '-3d'
            });
        }

        $(document).on('click', '.addRowButton', function() {
            let tableId = $(this).closest('table').attr('id');
            let optionID = $(this).closest('table').attr('data-optionID');
            let optionType = $(this).closest('table').attr('data-optionType');

            if(tableId == 'counter_option_tb1'+optionID) {
              appendToOptionTable(tableId,optionID,optionType)
            }
            if(tableId == 'counter_attribute_tbl') {
                appendToAttributeTable(tableId)
            }
            if(tableId == 'tbl') {
                appendToImageTable(tableId)
            }

        });

        $(document).on('click', '#DeleteOptionButton', function() {
          let tableId = $(this).closest('table').attr('id');
          $(this).closest("tr").remove();
          counter_option -= 1;
        });






        // Attribute Product
        var counter_attribute = 1;
        function appendToAttributeTable(tableId) {
            $(`#${tableId}`).append(`<tr class="tr_attribute_clone">
                                        <td><select class="form-control select2" name="attributesArray[${counter_attribute}][attribute_id]">
                                                @foreach($data['attributeArray'] as $key => $value)
                                                    <optgroup label="{{  $value->AdminProductAttributeGroupDescription->name }}">
                                                        @foreach($value->adminrelationAttributes as $key1 => $value1)
                                                            <option value={{ $value1->id }}>{{ $value1->name }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select></td>
                                        <td><textarea class="form-control" name="attributesArray[${counter_attribute}][text]" id="attribute_text_${counter_attribute}"  rows="4"></textarea></td>
                                        <td><button class="btn btn-danger" type="button" id="DeleteAttributeButton" ><icon class="fa fa-minus" /></button></td>
                                        </tr>`);

            counter_attribute += 1;
            $(".select2").select2();
        }

      $("#counter_attribute_tbl").on("click", "#DeleteAttributeButton", function() {
          $(this).closest("tr").remove();
          counter_attribute -= 1;
      });

      var optionArr = [];

      //add dynamic tab1$(document).ready(function() {
      function setOption(val) {
      console.log("otpion arr ",optionArr)
        if($(val).val() != '') {
          var addOption = false;
          if(optionArr.length == 0) {
            addOption = true;
            optionArr.push($(val).val())
          }
          else {
            if(!optionArr.includes($(val).val())) {
              addOption = true;
              optionArr.push($(val).val())
            }
          }
          console.log("otpion arr ",optionArr)
          let postID = optionArr.join(",");
          $('#optionPost').val(postID)
          if(addOption) {
            $(".appendTab button").each(function(){
              $(this).removeClass("btn-primary");
            });

            $(".table-option").each(function(){
              $(this).addClass("d-none");
            });
            $('.appendTab').append('<button type="button" onclick="optionClick(' +$(val).val()+')" class="btn btn-primary" id="btn'+$(val).val()+'" ><span style="margin-right:10px;" onclick="removeOption('+$(val).val()+')"> <i class="fas fa-minus-square"></i> </span> '+$(val).find('option:selected').text()+'</button></br>')
            $('.optionTable'+$(val).val()).removeClass('d-none');
            $('.optionTable'+$(val).val()).show();
          }
        }
      }

      function optionClick(id) {
        $(".appendTab button").each(function(){
          $(this).removeClass("btn-primary");
        });
        $(".table-option").each(function(){
          $(this).addClass("d-none");
        });
        $('#btn'+id).addClass('btn-primary');
        $('.optionTable'+id).removeClass('d-none');

      }

      function removeOption(id) {
          $('.optionTable'+id+' > tbody').find("tr:gt(0)").empty();
          $('.optionTable'+id).hide();
          optionArr = optionArr.filter((value)=>value!=id);
          let postID = optionArr.join(",");
          $('#btn'+id).remove();
          $('#optionPost').val(postID)
      }

          $(document).ready(function () {
             <?php foreach (getLanguages() as $key=>$language) { ?>
               $('.ckeditor<?php echo $language->id ?>').ckeditor();
           <?php    } ?>
          });

        //chatGPT stuff
        <?php  if(isset($chatGPT) && $chatGPT->enable)  { ?>

          function onProductNameChange(language) {
            if (this.timer) {
                window.clearTimeout(this.timer);
            }
            this.timer = window.setTimeout(function() {
              promoteChatGPT(language)
            }, 1000);
          }

          function promoteChatGPT(language) {
              if($('.productName'+language).val().length > 3) {
                  $('.chatGPTButton'+language).removeClass('d-none')
              }
              else {
                  $('.chatGPTButton'+language).addClass('d-none')
              }
          }

          //get content from chat GPT
          function getContentFromChatGPT(language) {
              let keyword = $('.productName'+language).val();

              $(".btn-chatgpt").attr("disabled", true);

              $('.btn-chatgpt').html(`<img src="{{asset('frontend/images')}}/artificial-intelligence.gif" height="50" />
                  <p classs=" font-weight-600 ">Please Wait...</p>
              `)

              var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
               $.ajax({
                 url: "{{route('get-content-from-chatGPT')}}",
                 type: 'post',
                 data:{'keyword' :keyword,'type' : 'product','language' : language ,'_token': CSRF_TOKEN},
                 success: function (response) {
                      $(".btn-chatgpt").removeAttr("disabled", true);
                      $('.btn-chatgpt').html(`<i class="fas fa-robot"></i> Get Content From ChatGPT`);
                      //set short description
                      $('.short_description'+language).val(response.short_desc)
                      //set description
                      CKEDITOR.instances['editor'+language].insertHtml(response.long_desc)
                    }
                })
              }

              //get seo content from chatGPT
              function getSeoContentFromChatGPT(language) {
                  let keyword = $('.productName'+language).val();
                  $(".btn-chatgpt").attr("disabled", true);
                  $('.btn-chatgpt').html(`<img src="{{asset('frontend/images')}}/artificial-intelligence.gif" height="50" />
                      <p classs=" font-weight-600 ">Please Wait...</p>
                  `)

                  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                   $.ajax({
                     url: "{{route('get-seo-content-from-chatGPT')}}",
                     type: 'post',

                     data:{'keyword' :keyword,'type' : 'product','language' : language ,'_token': CSRF_TOKEN},
                     success: function (response) {
                          $(".btn-chatgpt").removeAttr("disabled", true);
                          $('.btn-chatgpt').html(`<i class="fas fa-robot"></i> Get Content From ChatGPT`);
                          //set meta title
                          $('.meta_title'+language).val(response.meta_title)
                          //set meta description
                          $('.meta_description'+language).val(response.meta_description)
                          //set meta keywords
                          $('.meta_keyword'+language).val(response.meta_keywords)
                     }
                    })
                  }
        <?php } ?>

</script>
@endpush