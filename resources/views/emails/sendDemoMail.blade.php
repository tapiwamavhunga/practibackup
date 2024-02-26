@component('mail::message')

<div style="text-align: left; font-family: Arial; font-size: 14px;">Dear Health Champions
<br><br>
We are upgrading to our new, even better patient information sharing tool, click the button below to reset your password. </div>



<style type="text/css">
	.container {
    margin: 0 auto;
    width: 100%;
    text-align: center;
    font-size: 0;
    font-family: Arial, Helvetica, sans-serif;
    font-weight: 400;
    background: #ffffff;
}

h2.title {
    position: relative;
    margin-bottom: 15px;
    padding-bottom: 15px;
    font-size: 30px;
    color: #222222;
}

h2.title::after {
    position: absolute;
    content: "";
    width: 50px;
    height: 3px;
    left: calc(50% - 25px);
    bottom: 0;
    background: #222222;
}

p {
    position: relative;
    margin: 15px auto;
    font-size: 16px;
    color: #222222;
}

.btn {
    position: relative;
    display: inline-block;
    margin: 15px;
    padding: 12px 27px;
    text-align: center;
    font-size: 16px;
    letter-spacing: 1px;
    text-decoration: none;
    color: #999999;
    background: #ffffff;
    border: 3px solid #999999;
    cursor: pointer;
    transition: ease-out 0.5s;
    -webkit-transition: ease-out 0.5s;
    -moz-transition: ease-out 0.5s;
}

.btn.btn-border-1::after,
.btn.btn-border-1::before {
    position: absolute;
    content: "";
    width: 0%;
    height: 0%;
    visibility: hidden;
}

.btn.btn-border-1::after {
    bottom: -3px;
    right: -3px;
    border-left: 3px solid #222222;
    border-bottom: 3px solid #222222;
    transition: width .1s ease .1s, height .1s ease, visibility 0s .2s;
}

.btn.btn-border-1::before {
    top: -3px;
    left: -3px;
    border-top: 3px solid #222222;
    border-right: 3px solid #222222;
    transition: width .1s ease .3s, height .1s ease .2s, visibility 0s .4s;
}

.btn.btn-border-1:hover {
    animation: pulse 1s ease-out .4s;
    color: #222222;
}

.btn.btn-border-1:hover::after,
.btn.btn-border-1:hover::before {
    width: calc(100% + 3px);
    height: calc(100% + 3px);
    visibility: visible;
    transition: width .1s ease .2s, height .1s ease .3s, visibility 0s .2s;
}

.btn.btn-border-1:hover::after {
    transition: width .1s ease .2s, height .1s ease .3s, visibility 0s .2s;
}

.btn.btn-border-1:hover::before {
    transition: width .1s ease, height .1s ease .1s;
}

.btn.btn-border-2::after,
.btn.btn-border-2::before {
    position: absolute;
    content: "";
    width: 0;
    height: 0;
    transition: .5s;
}

.btn.btn-border-2::after {
    top: -3px;
    left: -3px;
    border-top: 3px solid transparent;
    border-left: 3px solid transparent;
}

.btn.btn-border-2::before {
    bottom: -3px;
    right: -3px;
    border-bottom: 3px solid transparent;
    border-right: 3px solid transparent;
}

.btn.btn-border-2:hover {
    color: #222222;
}

.btn.btn-border-2:hover::after,
.btn.btn-border-2:hover::before {
    width: calc(50% + 3px);
    height: calc(50% + 3px);
    border-color: #222222;
}

.btn.btn-border-3::after,
.btn.btn-border-3::before {
    position: absolute;
    content: "";
    width: 0;
    height: 0;
    transition: .5s;
}

.btn.btn-border-3::after {
    top: -9px;
    left: -9px;
    border-top: 3px solid transparent;
    border-left: 3px solid transparent;
}

.btn.btn-border-3::before {
    bottom: -9px;
    right: -9px;
    border-bottom: 3px solid transparent;
    border-right: 3px solid transparent;
}

.btn.btn-border-3:hover {
    color: #222222;
}

.btn.btn-border-3:hover::after,
.btn.btn-border-3:hover::before {
    width: 30px;
    height: 30px;
    border-color: #222222;
}

.btn.btn-border-4::after,
.btn.btn-border-4::before {
    position: absolute;
    content: "";
    width: 0;
    height: 0;
    transition: .5s;
}

.btn.btn-border-4::after {
    top: -9px;
    left: -9px;
    border-top: 3px solid transparent;
    border-left: 3px solid transparent;
}

.btn.btn-border-4::before {
    bottom: -9px;
    right: -9px;
    border-bottom: 3px solid transparent;
    border-right: 3px solid transparent;
}

.btn.btn-border-4:hover {
    color: #222222;
}

.btn.btn-border-4:hover::after,
.btn.btn-border-4:hover::before {
    width: calc(100% + 15px);
    height: calc(100% + 15px);
    border-color: #222222;
}

.btn.btn-border-5::after,
.btn.btn-border-5::before {
    position: absolute;
    content: "";
    width: 0;
    height: 0;
    transition: .5s;
}

.btn.btn-border-5::after {
    top: 0;
    left: 0;
    border-top: 3px solid transparent;
}

.btn.btn-border-5::before {
    bottom: 0;
    right: 0;
    border-bottom: 3px solid transparent;
}

.btn.btn-border-5:hover {
    color: #222222;
}

.btn.btn-border-5:hover::after,
.btn.btn-border-5:hover::before {
    width: 100%;
    height: 100%;
    border-color: #222222;
}
</style>
  <a class="btn btn-border-1" href="https://practitioner.medinformer.co.za/password/reset">Reset Password</a>



Thanks,<br>
<div style="text-align: left; font-family: Arial; font-size: 14px;">{{ config('app.name') }} Team
@endcomponent

</div>