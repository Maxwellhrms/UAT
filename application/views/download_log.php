<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

    <title>Download Log</title>
  </head>
  <body>
    <form method="POST">
            <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong id="text"></strong>
            </div>

            <section class="vh-100 gradient-custom">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card bg-dark text-white" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">

                                    <div class="mb-md-5 mt-md-4 pb-5">

                                    <h2 class="fw-bold mb-2 text-uppercase">Download Log</h2>
                                    <p class="text-white-50 mb-5">Please Select Date To Download Log File</p>

                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="date" name="date" class="form-control form-control-lg datepicker" readonly/>
                                        <label class="form-label" for="typeEmailX">Date</label>
                                    </div>

                                    

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit" name="submit">Download</button>

                                    <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                        <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                        <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                                        <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                    </div>

                                    </div>

                                    

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </form>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

 
    <script>
        $(document).ready(function(){
            $( function() {
                $( ".datepicker" ).datepicker({
                    dateFormat: 'yy-mm-dd'
                });
                $('.datepicker').datepicker('setDate', new Date());
            } );
        });
        
        
    </script>
    <script>
        // assumes you're using jQuery
        $(document).ready(function() {
            $('.alert').hide();
            <?php if($this->session->flashdata('msg')){ ?>
                    $('.alert').show();
                    $('#text').html('<?php echo $this->session->flashdata('msg'); ?>');
            <?php } ?>
            $(".close").click(function(){
                $('.alert').hide();
                $('#text').html('');
            });
        });
    </script>
  </body>
</html>