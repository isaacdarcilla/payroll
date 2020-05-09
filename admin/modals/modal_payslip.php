
<script type="text/javascript">
function printPage2(){
    var divElements = document.getElementById('printDataHolder2').innerHTML;
    var oldPage = document.body.innerHTML;
    document.body.innerHTML="<link rel='stylesheet' href='css/common.css' type='text/css' /><body class='bodytext'><div class='padding'><b style='font-size: 16px;'><p class=''>Payslip generated on <?php echo date("m/d/Y") ?> <?php echo date("G:i A") ?> by <?php echo $firstname ?> <?php echo $lastname ?></p></b></div>"+divElements+"</body>";
    window.print();
    document.body.innerHTML = oldPage;
    }
</script>
<div id="modal-show-payslip-<?php echo $numbers ?>" class="modal" data-backdrop="true" >
  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header">

           <div class="modal-body p-lg">       
              <div class="table-responsive push" id="printDataHolder2">
                  <table class="table table-bordered table-hover">
                    <tr>
      
                      <td colspan="5" class="font-w600 text-left">Precious Bros Construction Payslip</td>
                    </tr>
                    <tr>
              
                    <td colspan="2" class="font-w600 text-left">Pay Period</td>

                      <td colspan="3" class="text-center"><b><?php echo date('F d, Y', strtotime($from)) ?> <b>- </b><?php echo date('F d, Y', strtotime($to)) ?></b></td>
                    </tr>
                    <tr>
                     
                          <td colspan="2" class="font-w600 text-left">Employee Name</td>

                      <td colspan="3" class="text-center"><?php echo $row['fullname'] ?></td>
                    </tr>
                    <tr>
                    
                      <td>
                        <p class="font-w600 mb-1">App Design</p>
                        <div class="text-muted">Promotional mobile application</div>
                      </td>
                      <td class="text-center">
                        1
                      </td>
                      <td class="text-right">$3.200,00</td>
                      <td class="text-right">$3.200,00</td>
                    </tr>
                    <tr>
                      <td colspan="4" class="font-w600 text-right">Subtotal</td>
                      <td class="text-right">$25.000,00</td>
                    </tr>
                    <tr>
                      <td colspan="4" class="font-w600 text-right">Vat Rate</td>
                      <td class="text-right">20%</td>
                    </tr>
                    <tr>
                      <td colspan="4" class="font-w600 text-right">Vat Due</td>
                      <td class="text-right">$5.000,00</td>
                    </tr>
                    <tr>
                      <td colspan="4" class="font-weight-bold text-uppercase text-right">Total Due</td>
                      <td class="font-weight-bold text-right">$30.000,00</td>
                    </tr>
                  </table>
                </div>
          <!--       <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>
           -->
          </div>

    </div><!-- /.modal-content -->
          <div class="modal-footer">
        <div  style="padding-right: 12px;" >
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
        <button type="button" class="btn dark-white p-x-md">Print</button>
        </div>
      </div>
  </div>
</div>
</div>