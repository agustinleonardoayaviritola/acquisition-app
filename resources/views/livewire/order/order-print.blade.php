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
                                <table class="min-w-full border text-center">
                                    <tr class="border-b">
                                      <th rowspan="2" class="border-r">Cantidad</th>
                                      <th rowspan="2" class="border-r">Unidad de Manejo</th>
                                      <th rowspan="2" class="border-r">Descripcion del bien y/o Material</th>
                                      <th colspan="2" class="border-r">Precio Bs</th>
                                    </tr>
                                    <tr class="border-b">
                                      <th class="border-r">Unitario</th>
                                      <th class="border-r">Total</th>
                                    </tr>

                                    <tr class="border-b">
                                      <td class="border-r">12</td>
                                      <td class="border-r">Bolsas</td>
                                      <td class="border-r">
                                        FERTILIZANTE EDAFICO: Productos quimicos para la siembra y aporque de
                                        los principales cultivos, papa, ajo, avena, haba en las Estaciones
                                        experimentales de El Molino y Campanario....
                                      </td>
                                      <td class="border-r">460.00</td>
                                      <td class="border-r">5.520.00</td>
                                    </tr>

                                    <tr class="border-b">
                                      <td colspan="5">Sum: $180</td>
                                    </tr>
                                    <tr class="border-b ">
                                        <td  >Son: </td>
                                    </tr>

                                    <tr>
                                        <th colspan="2" class="border-r border-b">Nro. de Solicitud  de bienes materiales:</th>
                                        <th colspan="2" class="border-r">APROBACIÓN</th>
                                        <th >Vo.Bo</th>
                                    </tr>
                                    <tr>
                                        <th colspan="2" rowspan="3" class="border-r">Reparticion Solicitante:</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                    </tr>
                                  </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
