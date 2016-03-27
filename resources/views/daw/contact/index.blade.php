@extends('~layout.~template')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row margin-bottom-20">
                <div class="col-md-6">
                    <div class="space20">
                    </div>
                    <h3 class="form-section">{!! trans('messages.welcome.contact_men') !!}</h3>
                    <div class="well">
                        <h4>Address</h4>
                        <address>
                            <strong>Loop, Inc.</strong><br>
                            795 Park , Suite 120<br>
                            Cluj Napoca, CJ 94107<br>
                            <abbr title="Phone">P:</abbr> (+40) 145-1810 </address>
                        <address>
                            <strong>Email</strong><br>
                            <a href="mailto:#">
                               support@suport.com </a>
                        </address>
                        <ul class="social-icons margin-bottom-10">
                            <li>
                                <a href="javascript:;" data-original-title="facebook" class="facebook">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="github" class="github">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="Goole Plus" class="googleplus">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="linkedin" class="linkedin">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="rss" class="rss">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="skype" class="skype">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="twitter" class="twitter">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-original-title="youtube" class="youtube">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="space20">
                    </div>
                    <!-- BEGIN FORM-->
                    <form action="#">
                        <h3 class="form-section">Feedback</h3>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="fa fa-check"></i>
                                <input type="text" class="form-control" placeholder="Subject">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="fa fa-user"></i>
                                <input type="text" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-icon">
                                <i class="fa fa-envelope"></i>
                                <input type="password" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3=6" placeholder="Feedback"></textarea>
                        </div>
                        <button type="submit" class="btn green">Trimite</button>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="{!! asset('custom/css/metronic.components.css') !!}">
@stop