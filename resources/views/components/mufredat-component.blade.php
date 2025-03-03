<ul>
    @foreach($mufredatlar as $mufredat)
        <li><a href="{{$mufredat->dosya_yolu}}">{{ $mufredat->getAd(app()->getLocale()) }}</a></li>
    @endforeach
</ul>
