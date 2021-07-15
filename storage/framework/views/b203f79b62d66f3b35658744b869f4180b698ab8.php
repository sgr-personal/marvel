
<div class="invoice-box" style="max-width: 800px;margin: auto;padding: 25px;border: 1px solid #eee;box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);font-size: 14px;line-height: 24px;font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;color: #555;">
    <table cellpadding="0" cellspacing="0" style="width: 100%;line-height: inherit;text-align: left;">
        <tr class="top">
            <td colspan="2" style="padding: 5px;vertical-align: top;">
                <table>
                    <tr>
                        <td class="title" style="padding-bottom: 20px;font-size: 45px;line-height: 45px;color: #333;">
                            <img src="<?php echo e(base_path()."/upload/img/logo.png"); ?>" style="width: 100%; max-width: 300px" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="4" style="padding: 5px;vertical-align: top;">
                <table style="width: 100%;">
                    <tr>
                        <td style="text-align: left;padding-bottom: 40px;">
                            TEL:  +254 786 178372 ,0726 178372<br />
                            EMAIL: XGAMERtechnologies@gmail.com<br />
                            VAT PIN: P051741660D
                        </td>


                        <td style="text-align: right;padding-bottom: 40px;">
                            Shop number 501 (5th floor),<br />
                            Veteran House (Graffins college),<br />
                            Along Moi Avenue,<br />
                            Nairobi, Kenya
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="4" style="padding: 5px;vertical-align: top;">
                <table style="width: 100%;">
                    <tr>
                        <td style="text-align: left;padding-bottom: 40px;">
                            Mr/Mrs/Ms/Company: Patel Riya<br />
                            Phone: 96629670467<br />
                            Date: 01-08-2021<br />
                            KRA PIN: XXXXXXX
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="width: 100%;">
        <tr class="heading">
            
            <td style="padding: 5px;vertical-align: top;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;width: 30%">Name</td>
            <td style="padding: 5px;vertical-align: top;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;width: 40%">Description</td>
            <td style="padding: 5px;vertical-align: top;background: #eee;border-bottom: 1px solid #ddd;font-weight: bold;text-align: right;width: 20%">Price</td>
        </tr>
        <tbody>
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                
                <td style="padding: 5px;width: 30%;"><?php echo e($product->product_name); ?></td>
                <td style="padding: 5px;width: 40%;"><?php echo e(strip_tags($product->description)); ?></td>
                <td style="padding: 5px;width: 20%;text-align: right;"><?php echo e("ksh".$product->price); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <footer class="footer">
        <hr>
        <br>
        <blockquote style="padding-top: 450px;"> Remarks:</blockquote>
        <p style="font-size: 8px;">1. Confirm compatibility of the components,by contacting us on phone if you have generated this document
            using our online calculator www.XGAMERtechnologies.com/calc<br>
            2. Total cost cited above is not inclusive of VAT (Ksh 15,944.64) and 2% service (Ksh 1,954.00).<br>
            3. Payments are by cash or mpesa till number 492178, before any components are opened.80% (Ksh
            78,160.00)in the eventuality of deposit before assembly.
            For cheque and bank tranfers use bank name : I&M Bank LTD,<br> account name : XGAMERtechnologies (K)
            LIMITED ,account number: 00101943411250 ,amount: US DOLLAR 1,155.99
            For tax withholding agent : payable amount is USD 1,096.19 and withheld amount is Ksh 5,979.24</p>
    </footer>
</div>
<?php /**PATH D:\wamp64\www\marvel\resources\views/themes/ekart/quotation.blade.php ENDPATH**/ ?>