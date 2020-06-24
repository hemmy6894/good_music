
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <?php foreach($modelRoles as $role => $rValue){ ?>
                                        <div class="row" style="margin-top:8px">
                                            <div class="col-md-12"><strong> {{ $role }} </strong></div>
                                                <?php foreach($rValue as $key => $value){ ?>
                                                    <div class="col-md-3">
                                                        <?php
                                                            $array_value = explode('-',$key);
                                                            if($value == 1){
                                                                $checked = 'checked';
                                                                $value = 0;
                                                            }else{
                                                                $checked = '';
                                                                $value = 1;
                                                            }
                                                        ?>
                                                        <input type="checkbox" onclick="setUserRole('{{$value}}','{{$key}}')" <?=$checked;?> value="{{ $key }}" name="{{ $key }}" id="{{ $key }}"> {{ $array_value[0] }}
                                                    </div>
                                                <?php } ?>
                                        </div>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>