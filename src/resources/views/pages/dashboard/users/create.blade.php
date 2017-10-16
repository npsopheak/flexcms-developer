	<div class="productDetail">
		<div class="topContent row">
			<div class="col-md-6 form">
                <div class="form-group">
                    <label>Username</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i>
                        </span>
                        <input type="text" id="input1-group1" name="input1-group1" class="form-control" placeholder="Username">
                    </div>
                </div>
                <div class="form-group">
                    <label>Nickname</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-globe"></i>
                        </span>
                        <input type="text" id="input1-group1" name="input1-group1" class="form-control" placeholder="Username">
                    </div>
                </div>
                <div class="form-group">
                    <label>Full name</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-mobile-phone"></i>
                        </span>
                        <input type="text" id="input1-group1" name="input1-group1" class="form-control" placeholder="Username">
                    </div>
                </div>
                <div class="form-group">
                    <label>Full name</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-euro"></i>
                        </span>
                        <input type="text" id="input1-group1" name="input1-group1" class="form-control" placeholder="Username">
                    </div>
                </div>
			</div>
			<div class="col-md-6 image">
				<div class="kdaob">
                    <span class="fa fa-cloud-download fa-lg topicon"></span> 
                    <h3 class="des"> Drag & Drop a file</h3>
                    <div class="des"> or select an option below</div>
                    <div class="upload">
                        <button class="btn btn-success fa fa-image fa-lg  icon"></button>
                        <button class="btn btn-primary fa fa-video-camera fa-lg icon"></button>
                        <button class="btn btn-danger fa fa-link fa-lg icon"></button>
                    </div>
                    <div class="des"> Maximun Upload File Size: 25MB</div>
                </div>
			</div>
		</div>
        <div class="middleContent">
            <div class="col-md-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="javascript:void(0)" data-target="#detail" role="tab" aria-controls="detail"><i class="icon-globe"></i> Details &nbsp;</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="javascript:void(0)" data-target="#categories" role="tab" aria-controls="categories"><i class="icon-phone"></i> Categories &nbsp;</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="javascript:void(0)" data-target="#stock" role="tab" aria-controls="stock"><i class="icon-calculator"></i> Stock &nbsp;</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="javascript:void(0)" data-target="#gallery" role="tab" aria-controls="gallery"><i class="icon-picture"></i> Gallery &nbsp;</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="javascript:void(0)" data-target="#usage" role="tab" aria-controls="usage"><i class="icon-basket-loaded"></i> Usage &nbsp;</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="javascript:void(0)" data-target="#subproduct" role="tab" aria-controls="subproduct"><i class="icon-pie-chart"></i> Sub-Product</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="detail" role="tabpanel">
                        <div class="input-tab-detail">
                            <label for="text">Order Number</label>
                            <input type="number" class="form-control"></input>
                        </div>
                        <div class="input-tab-detail1">
                            <label for="text">Short Description</label>
                            <textarea  name="textarea-input" rows="4" class="form-control" style="z-index: auto; position: relative; line-height: 17.5px; font-size: 14px; transition: none; background: transparent !important;">
                            </textarea>
                        </div>
                        <div class="input-tab-detail1">
                            <label for="text">Description</label>
                            <textarea name="textarea-input" rows="8" class="form-control" style="z-index: auto; position: relative; line-height: 17.5px; font-size: 14px; transition: none; background: transparent !important;">
                            </textarea>
                        </div>
                        <div>
                            <label class="switch switch-3d switch-primary">
                                <input type="checkbox" class="switch-input" checked="">
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>
                            <label for="text" class="new-arrival">New Arrival</label>
                        </div>
                    </div>
                    <div class="tab-pane" id="categories" role="tabpanel">
                        <select class="form-control">
                            <option class="placehold">Brand</option>
                        </select>
                        <select class="form-control">
                            <option class="placehold">Brand</option>
                        </select>
                        <select class="form-control">
                            <option class="placehold">Brand</option>
                        </select>
                        <select class="form-control">
                            <option class="placehold">Brand</option>
                        </select>
                    </div>
                    <div class="tab-pane" id="stock" role="tabpanel">
                        <div class="qty-in-out">
                            <label>Quantity : 7</label>
                            <span class="icon-phone"></span>
                            <span class="icon-phone"></span>
                        </div>
                    </div>
                    <div class="tab-pane" id="gallery" role="tabpanel">
                        <h1>Media & Gallery</h1>
                        <div class="media-tab">
                            <div class="img1">
                                <div class="img-box">
                                    <div class="icon">
                                        <span class="icon-camera"></span>
                                        <label for="text"><i>member logo here</i></label>
                                    </div>
                                </div>
                            </div>
                            <div class="img2">
                                <div class="img-box">
                                    <img src="{{asset('/img/2fa6fa2b399f3d85d8f403d4ac5ec666--centro-pokemon-amigurumi-patterns.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="img2">
                                <div class="img-box">
                                    <img src="{{asset('/img/2fa6fa2b399f3d85d8f403d4ac5ec666--centro-pokemon-amigurumi-patterns.jpg')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="usage" role="tabpanel">
                        <div class="inlinehead">
                            <h1>Usage Images Description</h1>
                            <button class="btn btn-success btn-camera"><a><span class="icon-camera"></span></a></button>
                        </div>
                        <div class="media-tab">
                            <div class="img3">
                                <div class="img-box">
                                    <img src="{{asset('/img/2fa6fa2b399f3d85d8f403d4ac5ec666--centro-pokemon-amigurumi-patterns.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="img3">
                                <div class="img-box">
                                    <img src="{{asset('/img/2fa6fa2b399f3d85d8f403d4ac5ec666--centro-pokemon-amigurumi-patterns.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="img3">
                                <div class="img-box">
                                    <img src="{{asset('/img/2fa6fa2b399f3d85d8f403d4ac5ec666--centro-pokemon-amigurumi-patterns.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="img3">
                                <div class="img-box">
                                    <img src="{{asset('/img/2fa6fa2b399f3d85d8f403d4ac5ec666--centro-pokemon-amigurumi-patterns.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="img3">
                                <div class="img-box">
                                    <img src="{{asset('/img/2fa6fa2b399f3d85d8f403d4ac5ec666--centro-pokemon-amigurumi-patterns.jpg')}}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="media-tab">
                            <div class="img3">
                                <div class="img-box">
                                    <img src="{{asset('/img/2fa6fa2b399f3d85d8f403d4ac5ec666--centro-pokemon-amigurumi-patterns.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="img3">
                                <div class="img-box">
                                    <img src="{{asset('/img/2fa6fa2b399f3d85d8f403d4ac5ec666--centro-pokemon-amigurumi-patterns.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="img3">
                                <div class="img-box">
                                    <img src="{{asset('/img/2fa6fa2b399f3d85d8f403d4ac5ec666--centro-pokemon-amigurumi-patterns.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="img3">
                                <div class="img-box">
                                    <img src="{{asset('/img/2fa6fa2b399f3d85d8f403d4ac5ec666--centro-pokemon-amigurumi-patterns.jpg')}}" alt="">
                                </div>
                            </div>
                            <div class="img3">
                                <div class="img-box">
                                    <img src="{{asset('/img/2fa6fa2b399f3d85d8f403d4ac5ec666--centro-pokemon-amigurumi-patterns.jpg')}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="subproduct" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="tab-6-btn"><button class="this-btn">+</button></div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th class="tab-check">
                                            <input type="checkbox">
                                        </th>
                                        <th class="sku-tab">
                                            <label for="text">sku</label>
                                        </th>
                                        <th class="qty-tab">
                                            <label for="text">qty</label>
                                        </th>
                                        <th class="se-p">
                                            <label for="text">selling price</label>
                                        </th>
                                        <th class="st-p">
                                            <label for="text">stock price</label>
                                        </th>
                                        <th class="rem-tab">
                                            <label for="text">remark</label>
                                        </th>
                                        <th class="up-at">
                                            <label for="text">updated at</label>
                                        </th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td>hook smith</td>
                                            <td>hook smith</td>
                                            <td>hook smith</td>
                                            <td>hook smith</td>
                                            <td>hook smith</td>
                                            <td>hook smith</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="button">
                    <a class="btn btn-success btn-lg">Save</a>
                    <a class="btn btn-secondary btn-lg" >Cancel</a>
                </div>
            </div>
        </div>
	</div>