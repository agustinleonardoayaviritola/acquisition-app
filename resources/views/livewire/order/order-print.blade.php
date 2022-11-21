<div>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            Area de impresion
        </div>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div wire:ignore class="justify-center border-dashed bg-white border-2 m-8 p-4">
            <div id="printableArea" class="m-8 mt-0 p-2">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table cellspacing="0" class="min-w-full border text-xs">
                                    <tr class="border-b border-r" >
                                        <th colspan="1" align="center" class="border-r">
                                            <img class="object-center object-fill h-26 w-86 -m-2" src="{{ asset('/images/logo-gobernacion.svg') }}" alt="">
                                        </th>
                                        <th colspan="2" align="center" valign="middle" class="border-r">
                                            <h3>ORDEN DE COMPRA</h3>
                                            <h4>FORM.: SAF - ODT - 05</h4>
                                        </th>
                                        <th colspan="2" valign="middle" class="border-r">
                                            Nro Prenumerado
                                            {{$orden->application_number}}
                                            <p>&nbsp;</p>
                                            <hr>
                                            Fecha de Emisión
                                            <hr>{{$orden->issue_date}}
                                        </th>
                                    </tr>
                                    <tr class="border-b">
                                        <td colspan="5" class="border-r">
                                            <table class="min-w-full" width="100%" border="0" cellspacing="0">
                                                <tr class="border-b">
                                                    <td width="70%" class="border-r">
                                                        <p><strong>Señores(Nombre o Razón Social del Proveedor)</strong></p>
                                                        <p>{{$person->name}} {{$person->lastname}}</p>
                                                    </td>
                                                    <td rowspan="2" class="">
                                                        <p><strong>Dirección:</strong></p>
                                                        <p>{{$supplier->address}}</p>
                                                    </td>
                                                </tr>
                                                <tr class="border-b">
                                                    <td class="border-r"><strong>Persona de Contacto: </strong>{{$supplier->name}}</td>
                                                </tr>
                                                <tr class="">
                                                    <td class="border-r">
                                                        <strong>Tel/Fax: </strong>{{$telephone->number}}<br />
                                                        <strong>E-mail: </strong>{{$supplier->email}}
                                                    </td>
                                                    <td align="left" class="">
                                                        <strong>Plazo de Entrega: </strong>
                                                        {{$orden->delivery_time }} días
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="border-r" colspan="5"><strong>Observación:</strong><br />{{$orden->observation}}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <th class="border-r" colspan="5">DETALLE:</th>
                                    </tr>
                                    <tr class="border-b">
                                        <th rowspan="2" class="border-r">CANTIDAD PEDIDA</th>
                                        <th rowspan="2" class="border-r">UNIDAD DE MANEJO</th>
                                        <th rowspan="2" class="border-r">DESCRIPCIÓN DEL BIEN Y/O MATERIAL</th>
                                        <th colspan="2" class="border-r">PRECIO Bs.</th>
                                    </tr>
                                    <tr class="border-b">
                                        <th class="border-r">UNITARIO</th>
                                        <th class="border-r">TOTAL</th>
                                    </tr>
                                    @foreach ($orden_detail as $item)
                                    <tr class="border-b ">
                                        <td class="border-r min-w-full text-center">{{$item->quantity}}</td>
                                        @if($unidad->id)
                                        @if($item->unit_id === $unidad->id)
                                        <td class="border-r min-w-full text-center">{{$unidad->name}}</td>
                                        @else
                                        @endif
                                        @else
                                        <td class="border-r min-w-full text-center">sin datos</td>
                                        @endif
                                        <td class="border-r">
                                            {{$item->description}}
                                        </td>
                                        <td class="border-r min-w-full text-center"><?= number_format($item->price, 2, ',', '.') ?></td>
                                        <td class="border-r min-w-full text-center"><?= number_format($item->subtotal, 2, ',', '.') ?></td>
                                    </tr>
                                    @endforeach

                                    <tr class="border-b">
                                        <td colspan="5" class="border-r" align="right">
                                            <h4><strong>TOTAL BS. </strong><?= number_format($orden->total, 2, ',', '.') ?></h4>
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <td colspan="5" align="right" class="border-r" height="40">
                                            <p><strong>SON: </strong>{{$literal}} 00/100 Bolivianos.-</p>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td colspan="5" class="border-r">
                                            <table class="min-w-full text-center" width="100%" border="0" align="center" cellspacing="0" cellspacing="0">
                                                <tr class="">
                                                    <td width="33%" align="center" class="border-r">
                                                        <strong>Nro de Solicitud de bienes materiales: </strong>
                                                        <br>
                                                        {{$orden->code}}
                                                    </td>
                                                    <td width="33%" align="center" rowspan="2" class="border-r">
                                                        <strong>APROBACIÓN:</strong>
                                                        <p>&nbsp;</p>
                                                        <p>&nbsp;</p>
                                                        <p>&nbsp;</p>
                                                        
                                                        _______________________________<br />
                                                        DIRECTOR ADMINISTRATIVO
                                                    </td>
                                                    <td width="33%" align="center" rowspan="2" class="">
                                                        <strong>Vo.Bo</strong>
                                                        <p>&nbsp;</p>
                                                        <p>&nbsp;</p>
                                                        <p>&nbsp;</p>
                                                        _______________________________<br />
                                                        SECRETARIO DPTAL DE ECONOMIA Y FINANZAS
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <td align="center" class="border-r">
                                                        <p><strong>Reparticion Solicitante:</strong></p>
                                                            {{$unit_applicant->name}}
                                                            <br>
                                                            {{$peson_applicant->name}} {{$peson_applicant->lastname}}
                                                            <br>
                                                            {{$applicant_telephone->number}}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <p style="text-align: justify;">
                                    <strong class="font-bold">NOTA:</strong> Si los proponentes no entregasen el producto o servicio en el tiempo establecido por la orden de compra u orden de trabajo,
                                    seran pasibles a lo que establece el <strong>DS. 0956 Art. 2 Inc. j</strong>
                                </p>
                                <p style="text-align: justify;">
                                    Los términos y plazos comenzarán a correr a partir del día siguiente hábil a aquel en que tenga lugar la notificación
                                    o publicación del acto y concluyen al final de la última hora del día de su vencimiento.
                                </p>
                                <strong class="font-bold">Registro por:</strong> {{$peson_user->name}} {{$peson_user->lastname}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <x-jet-button id="btn_print" onclick="printDiv('printableArea')" class=" h-12 w-full rounded-full flex items-center bg-primary-500  justify-center">
            <i class="fas fa-print"></i>&nbsp; Imprimir
        </x-jet-button>
    </div>
</div>
<script>
    function printDiv(divName) {
        console.log('entrando');
        $("#btn_print").hide();
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

        $("#btn_print").show();
    }
</script>