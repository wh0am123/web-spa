<nav id="global-menu" class="global-menu">
    <h3><button type="button" name="button" id="categoriaButton" class="btn-invisible"><i class="fa fa-bars pull-left"></i> Categorías</button></h3>
    <ul class="nav navbar-nav ul-menu-general" id="MenuCategoria">
        @foreach($categories as $category)
            @if(count($category->subcategories) > 1)
                @if (count($category) > 12)
                    <li class="dropdown">
                    @else
                    <li class="dropdown cuadre-lista">
                @endif

                    @if (count($category) > 12)
                        <a href="#" class="dropdown-toggle lista-menu-principal2" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            {{$category->nombre}}<br>

                        </a>
                    @else
                        <a href="#" class="dropdown-toggle lista-menu-principal-2" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            {{$category->nombre}}<br>

                        </a>

                    @endif

                    {{-- <div class="descripcion-item-menu"><small>{{$category->descripcion}}</small></div> --}}

                    <ul class="dropdown-menu">
                        @foreach($category->subcategories as $subcategory)
                            <li><a class="lista-menu-principal" href="{{url('products/subcategory/?cat='.$subcategory->slug)}}">{{$subcategory->nombre}}</a></li>
                        @endforeach
                        {{-- <div class="contenedor-marcas">
                        @foreach($category->brands as $key => $brand)
                        <div class="marca">
                        <a href="{{url('products/brand?brand='.$key.'&cat='.$category->slug)}}" style="color:white;">{{$brand}}</a>
                    </div>
                @endforeach
            </div> --}}
            <div class="ver-todo">
                <a href="{{url('products/category?cat='.$category->slug)}}" class="btn btn-tauret btn-block">Ver todo</a>
            </div>
            @if(isset($prod_cat[$category->id]))
                <div class="destacado-menu">
                    @if(count($prod_cat[$category->id]->discounts) > 0)
                        <div class="green-label">
                            <span class="label rgba-green-strong">-{{$prod_cat[$category->id]->discount_percent}}%</span>
                        </div>
                    @endif
                <a class="link-destacado" href="{{url('product/'.$prod_cat[$category->id]->slug)}}">{!!Html::image('/images/products/'.$prod_cat[$category->id]->image)!!}</a>
                    @if($prod_cat[$category->id])
                        <div class="nombre-producto-menu">
                            <a href="{{url('product/'.$prod_cat[$category->id]->slug)}}" class="nom-menu">{{$prod_cat[$category->id]->title}}</a>
                        </div>
                        @if($prod_cat[$category->id]->quantity > 0)
                            <div class="price-en-menu">
                                @if(count($prod_cat[$category->id]->discounts) > 0)
                                    {{cop_format($prod_cat[$category->id]->discount_price)}}
                                @else
                                    {{cop_format($prod_cat[$category->id]->price)}}
                                @endif
                            </div>
                        @else
                            <div class="price-en-menu">
                                {{(strtotime($prod_cat[$category->id]->available_date) > strtotime(date('Y-m-d')) ? "Disponible en: ".$prod_cat[$category->id]->available_date : "Agotado")}}
                            </div>
                        @endif
                        <div class="text-center">
                            @if($prod_cat[$category->id]->quantity > 0)
                                {!!Form::open(['route'=>['add.cart',$prod_cat[$category->id]->slug],'method'=>'POST', 'class' => 'cart-form'])!!}{!!Form::hidden('qty', 1)!!}{!!Form::button('<i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Agregar', array('type' => 'submit', 'class'=>'btn btn-tauret btn-cart btn-block waves-effect waves-light'))!!}{!!Form::close()!!}
                            @else
                                {!!Form::open(['url'=>['notify_product'],'method'=>'POST', 'class' => 'cart-form'])!!}{!!Form::hidden('slug', $prod_cat[$category->id]->slug)!!}{!!Form::button('<i class="fa fa-mobile"></i>&nbsp;&nbsp;Notifícame', array('type' => 'submit', 'class'=>'btn btn-warning btn-cart btn-block waves-effect waves-light'))!!}{!!Form::close()!!}
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        </ul>
    </li>
@else
    @if (count($category) > 12)
        <li>
        @else
        <li class="cuadre-lista">
    @endif
        <a href="{{url('products/category?cat='.$category->slug)}}" class="lista-menu-principal">
            {{$category->nombre}}<br>
            <div class="descripcion-item-menu">{{$category->description}}</div>
        </a>
    </li>
@endif
@endforeach
</ul>

</nav>
