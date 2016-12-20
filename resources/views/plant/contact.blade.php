@extends('layouts.plant')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ url('css/contact.css') }}">
@endsection

@section('content')
<div style="width:100%; position:relative; height:350px;">
    <img src="{{ url('img/header/contact1.jpg')}}"  style="width:100%; height:100%; position:absolute;" />
</div>

<section id="contact" style="opacity: 1; background-position: 50% 10%;">
  <div class="container">
      <h2 class="main-title"><span>CONTACT</span></h2>
      <div class="row">
        <div class="col-md-6" id="map">
          <h4><b>Contact Information</b></h4>
          <dl>
            <dd class="contact_icon01">Address：545  University Road, 54561 Puli, Nantou Taiwan. </dd>
            <dd class="contact_icon02">Phone：+886-049-2910960 ext. 4543  </dd>
            <dd class="contact_icon03">Service Time：Monday to Friday AM 9:30 - PM 5:00 </dd>
            <dd class="contact_icon04">E-mail：<a href="mailto:@">@gmail.com</a></dd>
          </dl>
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2121.618293681777!2d120.92766726289527!3d23.95145435902087!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3468d83a34be0a89%3A0x439a2b43a6e8d825!2zNTQ15Y2X5oqV57ij5Z-U6YeM6Y6u5aSn5a246LevMeiZn-euoeeQhuWtuOmZog!5e0!3m2!1szh-TW!2stw!4v1478049274423" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
        <div class="col-md-6">
          <h4><b>Or leave your message, we'll contact you.</b></h4>
          <p>All the question you can ask , including how to buy / use it ...</p>
          <p>After receive your opinion, We'll contact you as soon as possible.</p>
          
          <ul class="w3-text-red">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
          <form method="post" action="{{ url('contact') }}" >
              {{ csrf_field() }}
              
              <label class="w3-label">聯絡人名稱</label>
              <input  class="w3-input" type="text" name="name" id="name" placeholder="Name" value="{{ old('name') }}">
                
              <label class="w3-label">公司名稱</label>
              <input  class="w3-input" type="text" name="company" id="company" placeholder="Company" value="{{ old('company') }}">
                
              <label class="w3-label">連絡電話</label>  
              <input  class="w3-input" type="tel" name="phone" id="phone" placeholder="Telephone"  value="{{ old('phone') }}">
                
              <label class="w3-label">聯絡信箱</label>
              <input  class="w3-input" type="email" name="email" id="email" placeholder="E-mail"  value="{{ old('email') }}">
                
              <label class="w3-label">需求敘述</label>
              <textarea  class="w3-input" type="text" name="message" id="message" placeholder="Description">{{ old('message') }}</textarea>

              
              <p class="w3-center w3-padding">
                <button class="w3-btn w3-round w3-blue">Submit</button>
              </p>
          </form>
        </div>
      </div>
  </div>
</section>
@endsection