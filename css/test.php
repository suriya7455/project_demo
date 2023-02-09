
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="plugin/myModal/myModal.js"></script>
<link rel="stylesheet" href="plugin/myModal/myModal.css" type="text/css">


<div id="listdatadetel" style="    width: 16%;
    background: #44d519;
    font-size: 27px;
    text-align: center;
    padding: 6px 0px;">test</div>






<div class="listDetalM"></div>





<script type="text/javascript">
    var lines = 'http://localhost/project_anime/';
    $(document).ready(function(){

listCOhortdetal();


    });
    function listCOhortdetal(){
  $(document).on('click','#listdatadetel',function(e){
    e.stopImmediatePropagation();

    var classPreview = 'listDetalM';
    var hasder = 'รายละเอียด';
    var linkModal = lines+'sever01.php';
    var styModal = '';
    var bt = '';
    var TextTb = '';
    
    previewModal(linkModal,classPreview,hasder,styModal,TextTb,bt);

  });

}
</script>