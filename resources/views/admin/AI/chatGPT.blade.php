@extends('admin.layouts.app')
@section('content')

    <div class="header bg-primary pb-3">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-black d-inline-block mb-0"> Chat GPT Setup</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form  action="{{route('update.chatGPT-config')}}" method="post">
      @csrf
    <div class="container-fluid">
      <div class="row  ">
          <div class="col">
            <div class="card p-3">
              <h4>Enable ChatGPT:  <select  name="enable_disable" onchange="updateChatGPTStatus(this.value)">
                  <option value="1" @if($config && $config->enable == true) selected="1" @endif>Yes</option>
                  <option value="0" @if(!$config || $config->enable == false) selected="0" @endif>No</option>
                </select>
            </h4>
          </div>
        </div>
      </div>
    </div>



    <!-- Page content -->
    <div class="container-fluid ">
      <div class="row  ">
          <div class="col ">
            <div class="card p-3">
              <h4 class="text-center">Add Your ChatGPT API Key</h4>
              <p class="font-weight-bold">Where ChatGPT Use?</p>
              <p class="font-weight-bold"><strong>Used In Product Description,Blog Description,Meta Keywords,Meta Description</strong>
                We will use ChatGPT for various work like writing product description,blog description,meta keywords and meta description so you can add content in less time.</p>
            <center>
              <div class="setup-form @if(!$config || $config->enable == false) d-none @endif">
                  <div class="col-6 my-3">
                       <label>ChatGPT API Key</label>
                    <input type="text" name="api_key" @if(!empty($config->api_key)) value="***********************{{substr($config->api_key, -5)}}" @endif class="form-control" placeholder="Enter your ChatGPT Api key here sk-..." >
                  </div>

                    <div class="col-6 my-3">
                    <label>ChatGPT Product Description</label>
                    <input type="text" name="product_description_text" value="{{old('product_description_text',isset($config) ? $config->product_description_text : '')}}" class="form-control" placeholder="Enter your product description text method (do not remove PRODUCT_NAME)">
                  </div>
                    <div class="col-6 my-3">
                         <label>ChatGPT Product Description Words</label>
                         <input type="number" name="product_description_words_count" value="{{old('product_description_words_count',isset($config) ? $config->product_description_words_count : 0)}}" class="form-control" placeholder="Enter product description words">
                    </div>
                       <div class="col-6 my-3">
                         <label>ChatGPT Blog Description</label>
                        <input type="text" name="blog_description_text" value="{{old('blog_description_text',isset($config) ? $config->blog_description_text : '')}}" class="form-control" placeholder="Enter your blog description text method (do not remove BLOG_TITLE)">
                  </div>
                   <div class="col-6 my-3">
                        <label>ChatGPT Blog Description Words</label>
                         <input type="number" name="blog_words_count" value="{{old('blog_words_count',isset($config) ? $config->blog_words_count : 0)}}" class="form-control" placeholder="Enter blog content words">
                    </div>
                </div>
                  <button  type="submit" class="btn btn-primary btn-upload text-white"><i class="fa fa-robot"></i> Update</button>
            </center>
        </div>
      </div>

    </div>
    </div>
  </form>

@push('js')
<script>
  function updateChatGPTStatus(val) {
      if(val == 1) {
        $('.setup-form').removeClass('d-none');
      }
      else {

        $('.setup-form').addClass('d-none');
    }
  }
</script>
@endpush
@endsection
