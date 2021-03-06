@extends('user.layout.home')

@section('keywords','armar-pc, personalizar-pc, crear-pc, configuracion-computador')

@section('body')
<div class="fixed-action-btn" style="bottom: 105px; right: 24px;">
    <a class="btn-floating btn-large btn-danger" data-toggle="modal" href="{{url('pc_build')}}" id="build_link">
        <i class="fa fa-desktop" aria-hidden="true"></i><span>pc</span> </a>
    </div>
    <div class="container guia">
        <div class="titulo">
            Arma tu PC
        </div>
        <div class="pc-guia">
            @if(isset($tecnologia))
            @include('admin.includes.alerts')
            <div class="tab-content">
                <div id="home" class="tab-pane fade in active">
                    <ul class="list-unstyled timeline widget">
                        <div class="block">

                            <div class="columna">
                                <li class="col-md-12">
                                    <div class="panel panel-default" style="max-height: 190px; height:100%">
                                        <div class="panel-body">
                                            <div class="procesadores col-sm-8">
                                                <h5>1. Servicio de Armado</h5>
                                                {!!Form::select('armado', $armado, null, ['class' => 'form-control browser-default', 'id' => 'armado', 'onchange' => 'add_armado(this.value)'])!!}
                                            </div>

                                            <div class="pull-right imagen-producto-elegido col-sm-2" id="costoArmado" hidden="hidden">
                                                <img src="" id="board_image" class="img-responsive">
                                                <p  class="pull-left gratis" >Gratis!</p>
                                            </div>

                                        </div>
                                    </div>
                                </li>

                                <li class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="procesadores col-sm-8">
                                                <h5>3. Selecciona la Board / Tarjeta Madre</h5>
                                                <select id="boards" name="boards" class="form-control browser-default" onchange="change_board(this.value)">
                                                    <option value="">Selecciona la Board / Tarjeta Madre</option>
                                                </select>
                                                <p id="board_precio" class="pull-left precio-pc precio-pc"></p>
                                            </div>
                                            <div class="col-sm-2">
                                                <h5>&nbsp;</h5>
                                                <a id="board_link" href="#" class="view-link hidden"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i></a>
                                                <a id="boards_delete" href="#" class="delete-link hidden"><i class="fa fa-times-circle text-danger fa-2x" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="pull-right imagen-producto-elegido col-sm-2">
                                                <img src="" id="board_image" class="img-responsive">

                                            </div>

                                        </div>
                                    </div>
                                </li>

                                <li class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="procesadores col-sm-8"  id="tvideo_parent">
                                                <h5>5. Selecciona la Tarjeta Gráfica</h5>
                                                {!!Form::select('tvideo', $tvideo, null, ['class' => 'form-control browser-default tvideo_field', 'placeholder' => 'Selecciona la Tarjeta Gráfica', 'id' => 'tvideo', 'onchange' => 'change_product(this.value, this.id)'])!!}
                                                <p id="tvideo_precio" class="pull-left precio-pc"></p>
                                            </div>
                                            <div class="col-sm-2">
                                                <h5>&nbsp;</h5>
                                                <a href="#" id="tvideo_link" class="view-link hidden"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i></a>
                                                <a id="tvideo_delete" href="#" class="delete-link hidden"><i class="fa fa-times-circle text-danger fa-2x" aria-hidden="true"></i></a>
                                                <a id="tvideo_add" href="#" class="add-link hidden"><i class="fa fa-plus-circle text-success fa-2x" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="pull-right imagen-producto-elegido col-sm-2" id="tvideo_sub">
                                                <img src="" id="tvideo_image" class="img-responsive">

                                            </div>

                                        </div>
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="procesadores col-sm-8" id="ssd_parent">
                                                <h5>7. Selecciona la Unidad SSD</h5>
                                                {!!Form::select('ssd', $ssd, null, ['class' => 'form-control browser-default ssd_field', 'placeholder' => 'Selecciona la Unidad SSD', 'id' => 'ssd', 'onchange' => 'change_product(this.value, this.id)'])!!}
                                                <p id="ssd_precio" class="pull-left precio-pc"></p>
                                            </div>
                                            <div class="col-sm-2">
                                                <h5>&nbsp;</h5>
                                                <a href="#" id="ssd_link" class="view-link hidden"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i></a>
                                                <a id="ssd_delete" href="#" class="delete-link hidden"><i class="fa fa-times-circle text-danger fa-2x" aria-hidden="true"></i></a>
                                                <a id="ssd_add" href="#" class="add-link hidden"><i class="fa fa-plus-circle text-success fa-2x" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="pull-right imagen-producto-elegido col-sm-2">
                                                <img src="" id="ssd_image" class="img-responsive">

                                            </div>

                                        </div>
                                    </div>
                                </li>
                                <li class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="procesadores col-sm-8">
                                                <h5>9. Selecciona el Gabinete</h5>
                                                {!!Form::select('chasis', $chasis, null, ['class' => 'form-control browser-default', 'placeholder' => 'Selecciona el Gabinete', 'id' => 'chasis', 'onchange' => 'change_product(this.value, this.id)'])!!}
                                                <p id="chasis_precio" class="pull-left precio-pc"></p>
                                            </div>
                                            <div class="col-sm-2">
                                                <h5>&nbsp;</h5>
                                                <a href="#" id="chasis_link" class="view-link hidden"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i></a>
                                                <a id="chasis_delete" href="#" class="delete-link hidden"><i class="fa fa-times-circle text-danger fa-2x" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="pull-right imagen-producto-elegido col-sm-2">
                                                <img src="" id="chasis_image" class="img-responsive">
                                            </div>

                                        </div>
                                    </div>
                                </li>

                                <li class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="procesadores col-sm-8">
                                                <h5>11. Selecciona la Refrigeración</h5>
                                                {!!Form::select('refri', $refri, null, ['class' => 'form-control browser-default', 'placeholder' => 'Selecciona la Refrigeración', 'id' => 'refri', 'onchange' => 'change_product(this.value, this.id)'])!!}
<p id="refri_precio" class="pull-left precio-pc"></p>
                                            </div>
                                            <div class="col-sm-2">
                                                <h5>&nbsp;</h5>
                                                <a href="#" id="refri_link" class="view-link hidden"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i></a>
                                                <a id="refri_delete" href="#" class="delete-link hidden"><i class="fa fa-times-circle text-danger fa-2x" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="pull-right imagen-producto-elegido col-sm-2">
                                                <img src="" id="refri_image" class="img-responsive">
                                            </div>

                                        </div>
                                    </div>
                                </li>

                                <li class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="procesadores col-sm-8">
                                                <h5>13. Selecciona el Teclado</h5>
                                                {!!Form::select('teclado', $teclado, null, ['class' => 'form-control browser-default', 'placeholder' => 'Selecciona el Teclado', 'id' => 'teclado', 'onchange' => 'change_product(this.value, this.id)'])!!}
<p id="teclado_precio" class="pull-left precio-pc"></p>
                                            </div>
                                            <div class="col-sm-2">
                                                <h5>&nbsp;</h5>
                                                <a href="#" id="teclado_link" class="view-link hidden"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i></a>
                                                <a id="teclado_delete" href="#" class="delete-link hidden"><i class="fa fa-times-circle text-danger fa-2x" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="pull-right imagen-producto-elegido col-sm-2">
                                                <img src="" id="teclado_image" class="img-responsive">
                                            </div>

                                        </div>
                                    </div>
                                </li>

                                <li class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="procesadores col-sm-8" id="accesorio_parent">
                                                <h5>15. Adicionales</h5>
                                                {!!Form::select('accesorio', $accesorio, null, ['class' => 'form-control browser-default accesorio_field', 'placeholder' => 'Selecciona el Periférico Adicional', 'id' => 'accesorio', 'onchange' => 'change_product(this.value, this.id)'])!!}
<p id="accesorio_precio" class="pull-left precio-pc"></p>
                                            </div>
                                            <div class="col-sm-2">
                                                <h5>&nbsp;</h5>
                                                <a href="#" id="accesorio_link" class="view-link hidden"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i></a>
                                                <a id="accesorio_delete" href="#" class="delete-link hidden"><i class="fa fa-times-circle text-danger fa-2x" aria-hidden="true"></i></a>
                                                <a id="accesorio_add" href="#" class="add-link hidden"><i class="fa fa-plus-circle text-success fa-2x" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="pull-right imagen-producto-elegido col-sm-2">
                                                <img src="" id="accesorio_image" class="img-responsive">
                                            </div>

                                        </div>
                                    </div>
                                </li>
                            </div>

                            <div class="columna">
                                <li class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="procesadores col-sm-8">
                                                <h5> 2. Selecciona el Procesador</h5>
                                                {!!Form::select('processors', $processors, null, ['class' => 'form-control browser-default', 'placeholder' => 'Selecciona el Procesador', 'id' => 'processors', 'onchange' => 'change_processor(this.value);'])!!}
<p id="procesador_precio" class="pull-left precio-pc"></p>
                                            </div>
                                            <div class="col-sm-1">
                                                <h5>&nbsp;</h5>
                                                <a id="processor_link" href="#" class="view-link hidden"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i></a>
                                                <a id="processors_delete" href="#" class="delete-link hidden"><i class="fa fa-times-circle text-danger fa-2x" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="pull-right imagen-producto-elegido col-sm-3">
                                                <img src="&nbsp;" id="processor_image" class="img-responsive">
                                            </div>

                                        </div>
                                    </div>
                                </li>

                                <li class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="procesadores col-sm-8" id="ram_parent">
                                                <h5>4. Selecciona la Memoria RAM</h5>
                                                <select id="ram" name="ram" class="form-control browser-default ram_field" onchange="change_product(this.value, this.id)">
                                                    <option value="">Selecciona la Memoria RAM</option>
                                                </select>
<p id="ram_precio" class="pull-left precio-pc"></p>
                                            </div>
                                            <div class="col-sm-2">
                                                <h5>&nbsp;</h5>
                                                <a href="#" id="ram_link" class="view-link hidden"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i></a>
                                                <a id="ram_delete" href="#" class="delete-link hidden"><i class="fa fa-times-circle text-danger fa-2x" aria-hidden="true"></i></a>
                                                <a id="ram_add" href="#" class="add-link hidden"><i class="fa fa-plus-circle text-success fa-2x" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="pull-right imagen-producto-elegido col-sm-2">
                                                <img src="" id="ram_image" class="img-responsive">
                                            </div>

                                        </div>
                                    </div>
                                </li>

                                <li class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="procesadores col-sm-8" id="tred_parent">
                                                <h5>6. Selecciona la Tarjeta de Red</h5>
                                                {!!Form::select('tred', $tred, null, ['class' => 'form-control browser-default tred_field', 'placeholder' => 'Selecciona la Tarjeta de Red', 'id' => 'tred', 'onchange' => 'change_product(this.value, this.id)'])!!}
<p id="tred_precio" class="pull-left precio-pc"></p>
                                            </div>
                                            <div class="col-sm-2">
                                                <h5>&nbsp;</h5>
                                                <a href="#" id="tred_link" class="view-link hidden"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i></a>
                                                <a id="tred_delete" href="#" class="delete-link hidden"><i class="fa fa-times-circle text-danger fa-2x" aria-hidden="true"></i></a>
                                                <a id="tred_add" href="#" class="add-link hidden"><i class="fa fa-plus-circle text-success fa-2x" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="pull-right imagen-producto-elegido col-sm-2">
                                                <img src="" id="tred_image" class="img-responsive">
                                            </div>

                                        </div>
                                    </div>
                                </li>

                                <li class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="procesadores col-sm-8" id="hdd_parent">
                                                <h5>8. Selecciona el Disco Duro</h5>
                                                {!!Form::select('hdd', $hdd, null, ['class' => 'form-control browser-default hdd_field', 'placeholder' => 'Selecciona el Disco Duro', 'id' => 'hdd', 'onchange' => 'change_product(this.value, this.id)'])!!}
    <p id="hdd_precio" class="pull-left precio-pc"></p>
                                            </div>
                                            <div class="col-sm-2">
                                                <h5>&nbsp;</h5>
                                                <a href="#" id="hdd_link" class="view-link hidden"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i></a>
                                                <a id="hdd_delete" href="#" class="delete-link hidden"><i class="fa fa-times-circle text-danger fa-2x" aria-hidden="true"></i></a>
                                                <a id="hdd_add" href="#" class="add-link hidden"><i class="fa fa-plus-circle text-success fa-2x" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="pull-right imagen-producto-elegido col-sm-2">
                                                <img src="" id="hdd_image" class="img-responsive">
                                            </div>

                                        </div>
                                    </div>
                                </li>

                                <li class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="procesadores col-sm-8">
                                                <h5>10. Selecciona la Fuente de Poder</h5>
                                                {!!Form::select('fuente', $fuente, null, ['class' => 'form-control browser-default', 'placeholder' => 'Selecciona la Fuente de Poder', 'id' => 'fuente', 'onchange' => 'change_product(this.value, this.id)'])!!}
<p id="fuente_precio" class="pull-left precio-pc"></p>
                                            </div>
                                            <div class="col-sm-2">
                                                <h5>&nbsp;</h5>
                                                <a href="#" id="fuente_link" class="view-link hidden"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i></a>
                                                <a id="fuente_delete" href="#" class="delete-link hidden"><i class="fa fa-times-circle text-danger fa-2x" aria-hidden="true"></i></a>
                                             </div>
                                            <div class="pull-right imagen-producto-elegido col-sm-2">
                                                <img src="" id="fuente_image" class="img-responsive">
                                            </div>

                                        </div>
                                    </div>
                                </li>

                                <li class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="procesadores col-sm-8">
                                                <h5>12. Selecciona el Mouse</h5>
                                                {!!Form::select('mouse', $mouse, null, ['class' => 'form-control browser-default', 'placeholder' => 'Selecciona el Mouse', 'id' => 'mouse', 'onchange' => 'change_product(this.value, this.id)'])!!}
                                                <p id="mouse_precio" class="pull-left precio-pc"></p>
                                            </div>
                                            <div class="col-sm-2">
                                                <h5>&nbsp;</h5>
                                                <a href="#" id="mouse_link" class="view-link hidden"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i></a>
                                                <a id="mouse_delete" href="#" class="delete-link hidden"><i class="fa fa-times-circle text-danger fa-2x" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="pull-right imagen-producto-elegido col-sm-2">
                                                <img src="" id="mouse_image" class="img-responsive">
                                            </div>

                                        </div>
                                    </div>
                                </li>

                                <li class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="procesadores col-sm-8" id="monitor_parent">
                                                <h5>14. Selecciona el Monitor</h5>
                                                {!!Form::select('monitor', $monitor, null, ['class' => 'form-control browser-default monitor_field', 'placeholder' => 'Selecciona el Monitor', 'id' => 'monitor', 'onchange' => 'change_product(this.value, this.id)'])!!}
<p id="monitor_precio" class="pull-left precio-pc"></p>
                                            </div>
                                            <div class="col-sm-1">
                                                <h5>&nbsp;</h5>
                                                <a href="#" id="monitor_link" class="view-link hidden"><i class="fa fa-info-circle fa-2x" aria-hidden="true"></i></a>
                                                <a id="monitor_delete" href="#" class="delete-link hidden"><i class="fa fa-times-circle text-danger fa-2x" aria-hidden="true"></i></a>
                                                <a id="monitor_add" href="#" class="add-link hidden"><i class="fa fa-plus-circle text-success fa-2x" aria-hidden="true"></i></a>
                                            </div>
                                            <div class="pull-right imagen-producto-elegido col-sm-3">
                                                <img src="" id="monitor_image" class="img-responsive">
                                            </div>

                                        </div>
                                    </div>
                                </li>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
            {!!Form::close()!!}
            @else
            
            </div>
            @endif
        </div>
    </div>
</div><!--fin container-->

<div class="modal fade" id="pleaseWaitDialog" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body text-center">
                <h1><i class="fa fa-spinner fa-spin"></i> Cargando...</h1>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
@endsection
@section('js')
<script type="text/javascript">
    var form_token = '{{csrf_token()}}';
</script>
{{Html::script('/js/armapc.js')}}

@endsection
