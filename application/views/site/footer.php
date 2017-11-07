<div class="footer">

    <div class="footer-content clearfix">
        <div class="container">
            <div class="row">
                <div class="footer-box col-md-3 col-sm-6 col-xs-12">
                    <div class="item"><h3><span>Về ch&#250;ng t&#244;i</span></h3></div>
                    <p style="color: #aaaaaa; font-size: 14px">Trang web chính thức giới thiệu về nhà hàng. Nơi cập nhật tin tức thường xuyên, cung cấp thông tin mới chính xác nhất về các chương trình ưu đãi đã, đang và sẽ áp dụng tại nhà hàng. Hỗ trợ tư vấn miễn phí, đặt bàn nhanh chóng và uy tín nhất!</p>
                </div>
                <div class="footer-box box-address col-md-3 col-sm-6 col-xs-12">
                    <div class="item">
                        <h3><span>Liên hệ</span></h3>
                        <div class="box-address-content">
                            <b><?php echo $content->company_name ?></b>
                            <p><i class="fa fa-map-marker"></i> <?php echo $content->address ?></p>
                            <p>
                                <i class="fa fa-envelope"></i>
                                <a href="mailto:info@runtime.vn"><?php echo $content->email ?></a>
                            </p>
                            <p>
                                <i class="fa fa-phone"></i><?php echo phone_format($content->phone) ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="footer-box box-social col-md-3 col-sm-6 col-xs-12">
                    <div class="item">
                        <h3>
                            <span>Liên kết</span>
                        </h3>
                        <div class="fb-like-box" data-href="#" data-width="289"
                             data-height="190" data-colorscheme="dark" data-show-faces="true" data-header="false"
                             data-stream="false" data-show-border="false">
                        </div>
                        <div class="social-icon">
                            <ul>
                                <li><a href="<?php echo $content->google ?>" ><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="<?php echo $content->facebook ?>" ><i class="fa fa-facebook"></i></a></li>
                                <li><a href="<?php echo $content->youtube ?>"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="<?php echo $content->twitter ?>"><i class="fa fa-twitter "></i></a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="footer-box box-letter col-md-3 col-sm-6 col-xs-12">
                    <div class="item">
                        <h3><span>Đăng ký nhận tin</span></h3>
                        <div class="letter-title">
                            <span>Hộp thư</span><i class="icon-title"></i>
                        </div>
                        <div class="letter-content">
                            <div class="new-paper">
                                <div class="input-box">
                                    <input type="text" name="email" id="txtNewsletter" class="input-text form-control" value="" placeholder="Your Emain Address" />
                                </div>
                                <div class="button text-center">
                                    <a class="btn btn-primary">Nhận tin</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>