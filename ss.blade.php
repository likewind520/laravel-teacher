<div class="part-right">
    <p class="part-suggest-title">热销推荐</p>
    <div class="slideBox">
        <div class="slider-film">
            <?php $i = 0;?>
            @foreach($oneFloor['data'] as $v)
                <?php $i++;?>
                @if($i>=3 and $i<7)
                    <a href="{{route ('home.content',['content'=>$v['id']])}}">
                        <dl>
                            <dt><img src="{{$v['list_pic']}}" width="50"></dt>
                            <dd class="title">{{$v['title']}}</dd>
                            <dd class="info">{{$v['description']}}</dd>
                            <dd class="price"><i class="yen">￥</i>{{$v['price']}}</dd>
                        </dl>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</div>
