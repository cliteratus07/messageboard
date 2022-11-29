<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4 mb-sm-5">
                <div class="card card-style1 border-0">
                    <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                        <div class="row align-items-center">
                            <div class="col-lg-6 mb-4 mb-lg-0">
                            <?php echo $this->Html->image($user['User']['image'], array('class' => 'image img-thumbnail rounded mx-auto d-block', 'height' => '250', 'width' => '250', 'fullBase' => true, 'plugin' => false)); ?>

                            </div>
                            <div class="col-lg-6 px-xl-10">
                                <div class="bg-secondary d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
                                    <h3 class="h2 text-white mb-0"><?php echo $user['User']['username']; ?></h3>
                                </div>
                                <ul class="list-unstyled mb-1-9">
                                    <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Email:</span> <?php echo $user['User']['email']; ?></li>
                                    <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Birthdate:</span> <?php echo date("M/d/Y", strtotime($user['User']['birthdate'])); ?></li>
                                    <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Age:</span> <?php echo $user['User']['age']; ?></li>
                                    <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Gender:</span> <?php echo $user['User']['gender']; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-4 mb-sm-5">
                <div>
                    <span class="section-title text-primary mb-3 mb-sm-4">Hubby</span>
                    <p><?php echo $user['User']['hubby']; ?></p>
               </div>
            </div>
            
        </div>
    </div>
    <?php 
echo $this->Html->css('profile');
?>
</section>