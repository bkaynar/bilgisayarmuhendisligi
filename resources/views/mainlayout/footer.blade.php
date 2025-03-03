<footer>
    <div class="container">
        <div class="top-footer">
            <div class="row justify-content-between">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="widget widget-about">
                        <img src="{{ asset('mainassets/assets/img/logo.png') }}" alt=""
                        srcset="{{ asset('mainassets/assets/img/logo.png') }} 5x">
                    </div><!--widget-about end-->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="widget widget-links">
                        <h3 class="widget-title">{{__('messages.Quick Links')}}</h3>
                        <ul>
                            <li><a href="https://obs.ahievran.edu.tr" title="" target="_blank">{{__('messages.Öğrenci Bilgi Sistemi')}}</a></li>
                            <li><a href="https://unis.ahievran.edu.tr" title="" target="_blank">{{__('messages.Akademik Web Sayfaları')}}</a></li>
                            <li><a href="https://bkys.ahievran.edu.tr/editMemnuniyetYonetimi" title="" target="_blank">{{__('messages.Memnuniyet Anketi')}}</a></li>
                            <li>
                                <a href="https://idari.ahievran.edu.tr/bidb/sayfa/Wi-FiKullanim/tr/51" title="" target="_blank">{{__('messages.Wi-Fi Kullanımı')}}</a>
                            </li>
                            <li><a href="{{route('news')}}" title=""target="_blank">{{__('messages.Haberler')}}</a></li>
                            <li><a href="{{route('contact')}}" title="">{{__('messages.Contact')}}</a></li>
                        </ul>
                    </div><!--widget-links end-->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="widget widget-iframe">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3094.412946445208!2d34.117252076597765!3d39.14258837167266!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14d50d492db57789%3A0x7f131464dc8c810c!2zTcO8aGVuZGlzbGlrIE1pbWFybMSxayBGYWvDvGx0ZXNp!5e0!3m2!1str!2str!4v1741002994693!5m2!1str!2str" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div><!--widget-iframe end-->
                </div>
            </div>
        </div><!--top-footer end-->
        <div class="bottom-footer">
            <div class="row align-items-center justify-content-center">
                <div class="mx-auto">

                    <p>
                        Bu website Kırşehir Ahi Evran Üniversitesi Bilgisayar Mühendisliği öğrencisi <a href="https://burakkaynar.tr" target="_blank">Burak KAYNAR</a> tarafından geliştirilmiştir.
                    </p>
                </div>

            </div>
        </div><!--bottom-footer end-->
    </div>
</footer><!--footer end-->
