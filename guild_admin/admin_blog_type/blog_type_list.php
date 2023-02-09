<div class="container-fluid">
    <?php
    if (isset($_POST['submit_file'])) {
        /** PHPExcel */
        require_once 'plugins/PHPExcelReader/PHPExcel/Classes/PHPExcel.php';
        /** PHPExcel_IOFactory - Reader */
        include 'plugins/PHPExcelReader/PHPExcel/Classes/PHPExcel/IOFactory.php';
        $inputFileName = $_FILES["file"]["tmp_name"];
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($inputFileName);



            // for No header start
            $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
            $highestRow = $objWorksheet->getHighestRow();
            $highestColumn = $objWorksheet->getHighestColumn();

            $r = -1;
            $namedDataArray = array();
            for ($row = 2; $row <= $highestRow; ++$row) {
                $dataRow = $objWorksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);
                if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                    ++$r;
                    $namedDataArray[$r] = $dataRow[$row];
                }
            }
            for ($i = 0; count($namedDataArray) > $i; $i++) {
                $data1 = $namedDataArray[$i]["A"];
                // Check ซ้ำ
                $sql_check = " SELECT * FROM blog_type WHERE blog_type_name = '$data1' ";
                $result_check = mysqli_query($conn, $sql_check);
                $num_check = mysqli_num_rows($result_check);
                if ($num_check == 1) {
                    $sql = "UPDATE blog_type SET blog_type_name = '$data1' WHERE blog_type_name = '$data1' ";
                    $result = mysqli_query($conn, $sql);
                }
                if ($num_check == 0) {
                    $sql = " INSERT INTO blog_type SET blog_type_name = '$data1' ";
                    $result = mysqli_query($conn, $sql);
                }
            }
            if ($result) {
                $msg = "<div class=\"alert alert-success text-center\">นำเข้าข้อมูลสำเร็จ</div>";
            }
        } catch (\Throwable $th) {
            $msg = "<div class=\"alert alert-danger text-center\">นำเข้าข้อมูลไม่สำเร็จ</div>";
        }
    }
    ?>
    <?php
    if ($msg != "") {
        echo $msg;
    }
    ?>
    <div class="card">
        <div class="card-header">
            <a href="index.php?mn=blog_type&file=blog_type_add" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover text-nowrap" id="blog_type-grid">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">ประเภทบทความ</th>
                            <th class="text-center">เมื่อ</th>
                            <th class="text-center">ตัวจัดการ</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="card-footer">
            &nbsp;
        </div>
    </div>