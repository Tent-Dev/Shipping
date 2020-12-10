<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Lists</title>

    <link rel="stylesheet" href="lib/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link href="lib/fontawesome-free-5.15.1-web/css/all.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="lib/jQuery/jquery-3.5.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="lib/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js" type="text/javascript" charset="utf-8"></script>

    <style>
        .form-title {
            margin-top: 20px;
            margin-bottom: 5px;
            padding: 3px;
            text-align: center;
            border-radius: 10px;
            background-color: #d2e5ff;
        }
    </style>
</head>
<body>
    <?php include('menu_layout.php'); ?>
    
    <section>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3">
                <h2>เพิ่มพัสดุ</h2>
                <form action="" method="post">
                    <div id="form-section">
                        <p class="form-title">ข้อมูลผู้ส่ง</p>
                        <div class="row">
                            <div class="col">
                                <label for="s_fname" class="col-form-label col-form-label-sm">ชื่อผู้ส่ง</label>
                                <input type="text" name="s_fname" id="s_fname" class="form-control form-control-sm">
                            </div>
                            <div class="col">
                                <label for="s_lname" class="col-form-label col-form-label-sm">นามสกุลผู้ส่ง</label>
                                <input type="text" name="s_lname" id="s_lname" class="form-control form-control-sm">
                            </div>
                        </div>
                        
                        <div class="section">
                            <p class="form-title">ข้อมูลผู้รับ</p>
                            <div class="row">
                                <div class="col">
                                    <label for="r_fname" class="col-form-label col-form-label-sm">ชื่อผู้รับ</label>
                                    <input type="text" name="r_fname[]" id="r_fname" class="form-control form-control-sm">
                                </div>
                                <div class="col">
                                    <label for="r_lname" class="col-form-label col-form-label-sm">นามสกุลผู้รับ</label>
                                    <input type="text" name="r_lname[]" id="r_lname" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="address" class="col-form-label col-form-label-sm">ที่อยู่</label>
                                    <textarea type="text" name="address" id="address" class="form-control form-control-sm" rows="3"></textarea>
                                </div>
                                <div class="col">
                                    <label for="tel" class="col-form-label col-form-label-sm">เบอร์โทร</label>
                                    <input type="text" name="tel" id="tel" class="form-control form-control-sm" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="weight" class="col-form-label col-form-label-sm">น้ำหนัก</label>
                                    <input type="text" name="weight" id="weight" class="form-control form-control-sm" value="">
                                </div>
                                <div class="col">
                                    <label for="price" class="col-form-label col-form-label-sm">ราคา</label>
                                    <input type="text" name="price" id="price" class="form-control form-control-sm" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <a href="#" class="addsection btn btn-sm btn-info">เพิ่มผู้รับ</a>
                        </div>
                        <div class="col-6 text-right">
                            <a href="" class="btn btn-sm btn-success">บันทึก</a>
                            <a href="" class="btn btn-sm btn-danger">ยกเลิก</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    var form_clone = $('#form-section .section:first').clone();
    var sectionsCount = 1;

    $('body').on('click', '.addsection', function() {
        sectionsCount++;

        var section = form_clone.clone().find(':input').each(function(){
            var newId = this.id + sectionsCount;
            $(this).prev().attr('for', newId);
            this.id = newId;
        }).end().appendTo('#form-section');

        return false;
    });
</script>
</body>
</html>