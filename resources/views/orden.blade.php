<!DOCTYPE html>
<html>
    <head>
        <title>Petricorp - Servicios para Imprentas</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title"><img src="{{URL::to('logos/petricorp.png')}}"/></div>
                <h2>Orden de compra</h2>
                <div>Imprenta: <b>{{$orden->imprenta->nombre}}</b></div>
                <div>Orden de compra: <b>{{$orden->numero_de_orden}}</b></div>
                <div>Archivos disponibles hasta: <b>{{$orden->valido_hasta->format('d/m/Y')}}</b></div>
                @if($orden->comentarios)
                <h2>Comentarios</h2>
                <div>{{$orden->comentarios}}</div>
                @endif

                @if(isset($orden->lista_archivos))
                <h2>Archivos</h2>
                    @foreach($orden->lista_archivos as $k => $archivo)
                    <div><a href="{{URL::to('archivo?codigo='.$orden->codigo.'&idx='.$k)}}">{{$archivo}}</a></div>
                    @endforeach
                @endif
            </div>
        </div>
    </body>
</html>
