@if ($paginator->hasPages())
    <div id="layui-table-page1">
        <div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-19">
            @if ($paginator->onFirstPage())
                <a href="javascript:;" class="layui-laypage-prev layui-disabled" data-page="12"><i class="layui-icon"></i></a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="layui-laypage-prev"><i class="layui-icon"></i></a>
            @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="layui-laypage-spr">{{ $element }}</span>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>{{ $page }}</em></span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="layui-laypage-next"><i class="layui-icon"></i></a>
            @else
                <a href="javascript:;" class="layui-laypage-next layui-disabled" data-page="14"><i class="layui-icon"></i></a>
            @endif
            <span class="layui-laypage-skip">
                <form method="get" class="layui-laypage-skip" action="">
                    <?php $query = request()->all(); ?>
                    @if(is_array($query))
                        @foreach ($query as $pa => $va)
                            @if($pa != 'page')
                                <input type="hidden" name="{{$pa}}" value="{{$va}}" />
                            @endif
                        @endforeach
                    @endif
                    到第<input name="page" type="text" min="1" value="{{ $paginator->currentPage() }}" class="layui-input">页<button type="submit" class="layui-laypage-btn">确定</button>
                </form>
            </span>
            <span class="layui-laypage-count">共 {{$paginator->total()}} 条</span>
        </div>
    </div>
@endif