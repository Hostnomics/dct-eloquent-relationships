
@extends('admin.layout.nurse')

@section('content')

<div class="wrapper wrapper-content animated fadeInRight ecommerce"> 

<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                
                
                @if (Session::has('success'))
                    <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
                @if (Session::has('failed'))
                    <div class="alert alert-danger text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('failed') }}</p>
                    </div>
                @endif




                <div class="table-responsive">
                    
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="bpTable">
                                        
                                          
                                <thead>
                                           
                                        <tr>
                                                        <!--<th style="display:none;">Last BP Date</th>-->
                                                        <!--<th style="display:none;">MRN</th>-->
                                                        <!--<th style="display:none;">Email</th>-->
                                                        <!--<th style="display:none;">DOB</th>-->
                                                        <!--<th>ID</th>-->
                                                
                                                
                                                <th style="display:none;">Sortable Raw Bill Number</th>
                                                    
                                                <th style="text-align:center; vertical-align:middle;">Bill Number</th>
                                                
                                                <th style="text-align:center; vertical-align:middle;">Patient</th>
                                                
                                                        <!--<th>Email</th>-->
                                                
                                                <th style="text-align:center; vertical-align:middle;">Unique Days</th>
                                                
                                                <th style="text-align:center; vertical-align:middle;">Days Period</th>
                                                
    
                                                <th style="text-align:center; vertical-align:middle;">Clinic Time</th>
                                                
                                                <th style="text-align:center; vertical-align:middle;">Clinic Period</th>
                                                
    
                                                <th style="text-align:center; vertical-align:middle;">CPT Codes</th>
                                                
                                                <th style="width: 20%; text-align:center; vertical-align:middle;">Billing Notes</th>
                                            
              
                                           
                                        </tr>
                                </thead>
                                <tbody>
                                         
                                   
        <!-- *********************************** NEW TABLE Mon Feb 7 2022 **************************************-->                                  
                     
                @foreach($invoices as $invoice)
                   
                
                        <?php
                        
                                if($invoice->invoice_stage >= '0'){
                                    $setBackgroundColor = "transparent"; 
                                    $setFontColor = "black"; 
                                }
                                
                    
    // Since default value of billable_time is 0, we must use triple ===, double defaults to true! https://stackoverflow.com/questions/6239766/compare-variables-php
                                
                                if($invoice->invoice_stage === 'proceed'){
                                    $setBackgroundColor = "green"; 
                                    $setFontColor = "white"; 
                                }
                                
                                if($invoice->invoice_stage === 'hold'){
                                    $setBackgroundColor = "#ff4500"; 
                                    $setFontColor = "white"; 
                                }
                                
                                if($invoice->invoice_stage === 'sent'){
                                    $setBackgroundColor = "blue"; 
                                    $setFontColor = "white"; 
                                }
                
                        
                     
                        ?>
                        
                                    <tr>
    
    
                                        
                                        <td style="display:none;">
                                            {{ $invoice->wendy_number }}
                                        </td>
                                        
                                        <td style="background-color:{{ $setBackgroundColor }}; color:{{ $setFontColor }};">
                                             {{ $invoice->wendy_number }}   
                                        </td>
              
              
                                        <td style="background-color:{{ $setBackgroundColor }}; color:{{ $setFontColor }};">
                                            
                                        <!--<div style="text-align:center">-->
                                        
    <!--ELOQUENT RELATIONSHIP FINALLY WORKING: https://laravel.com/docs/5.2/eloquent-relationships#one-to-one-->
    <?php // IT IS WORKING!!! https://i.imgur.com/YAtDOWV.png ?>
                                            <b style="text-align:center;" class="elementorFreedom">{{ ucwords($invoice->user->name) }}</b>
    
                                        </td>
                                        
                                       
                                       
                                         <td style="background-color:{{ $setBackgroundColor }}; color:{{ $setFontColor }}; font-size:20px; text-align:center; vertical-align:middle;" class="elementorFreedom">
                                            
                                            
                                                    {{ $invoice->number_days_to_bill ?? 'N/A' }} days
    
               
                                        </td>
                                       
                                       
                                        
                                        <td style="background-color:{{ $setBackgroundColor }}; color:{{ $setFontColor }}; text-align:center; vertical-align:middle;">
                                            <?php
                                              $ahoraEs = new DateTime(null, new DateTimeZone('America/New_York'));
                                              
                                              
            // HARD CODE END OF DAYS PERIOD AS 10/31/2022
                                            //   $currentDia = $ahoraEs->format('m/d/y');
                                              $currentDia = $invoice->cut_days_billing_date;
                                              $format_cut_days_billed = new DateTime($currentDia);
                                              $displayCutDaysBilled = strtolower($format_cut_days_billed->format('m/d/y'));
                                            
                                              $lastDaysBilled = $invoice->last_days_billing_date; 
                                              $format_last_days_billed = new DateTime($lastDaysBilled);
                                              $displayLastDaysBilled = strtolower($format_last_days_billed->format('m/d/y'));
    
                                            
    
                                            
                                            ?>
                                            
                                            From: <b class="elementorFreedom">{{ $displayLastDaysBilled }}</b> 
                                            <br>
                                            To: <b class="elementorFreedom">{{ $displayCutDaysBilled }}</b>
                                            <br>
                                            <br>
    
                                            
                                        </td>
    
                
                                      
                                        
    
                                         
                                         <td style="background-color:{{ $setBackgroundColor }}; color:{{ $setFontColor }}; text-align:center; vertical-align:middle;">
                                                
                                                {{ $invoice->number_time_to_bill ?? 'N/A' }} mins 
                                                      
                                        </td>
                                        
    
                                   
    
           <!--SINGLE CALL TO ACTION BUTTON -->
           
                                         <td style="background-color:{{ $setBackgroundColor }}; color:{{ $setFontColor }}; text-align:center; vertical-align:middle;">
                                            <?php
                                              $ahoraEs = new DateTime(null, new DateTimeZone('America/New_York'));
                                              
                                              
            // HARD CODE END OF DAYS PERIOD AS 10/31/2022
                                            //   $currentDia = $ahoraEs->format('m/d/y');
                                              $currentDiaTime = $invoice->cut_time_billing_date;
                                              $format_cut_time_billed = new DateTime($currentDiaTime);
                                              $displayCutTimeBilled = strtolower($format_cut_time_billed->format('m/d/y'));
                                            
                                              $lastTimeBilled = $invoice->last_time_billing_date; 
                                              $format_last_time_billed = new DateTime($lastTimeBilled);
                                              $displayLastTimeBilled = strtolower($format_last_time_billed->format('m/d/y'));
                                   
                                            ?>
                                            
                                            From: <b class="elementorFreedom">{{ $displayLastTimeBilled }}</b> 
                                            <br>
                                            To: <b class="elementorFreedom">{{ $displayCutTimeBilled }}</b>
                                            <br>
                                            <br>
                                 
                                            
                                            
                                        </td>
                                        
                                        
                                        
                                       <td style="background-color:{{ $setBackgroundColor }}; color:{{ $setFontColor }}; text-align:center; vertical-align:middle;">
                                             Days CPT: <b class="elementorFreedom">{{ $invoice->days_cpt_code }}</b> 
                                            <br>
                                            TIME CPT: <b class="elementorFreedom">{{ $invoice->time_cpt_codes }}</b>
                                            <br>
                                            <br>
                                            
                                            
                                        </td>
                                        
                                        
                                        
                                        <td style="width: 20%; background-color:{{ $setBackgroundColor }}; color:{{ $setFontColor }}; text-align:center; vertical-align:middle;">
                                            {{ $invoice->bill_notes }}
                                        </td>
               
                @endforeach
                                        
             
    
                                </tbody>
                        
                            </table>                                     
    
                    </div> <!--End of Table Responsive-->
    
                <!--Close Divs-->
                        </div>
                    </div>
                </div>
            </div>
    
    
        </div>
     <!--Close Divs-->
    
    @endsection
    
    @push('scripts')
    <!-- Data picker -->
    <script src="{{ asset( 'adminAndCompany/js/plugins/datapicker/bootstrap-datepicker.js' ) }}"></script>
    
    
    <!-- DataTable -->
    <script src="{{ asset( 'adminAndCompany/js/plugins/dataTables/datatables.min.js' ) }}"></script>
    <script src="{{ asset( 'adminAndCompany/js/plugins/dataTables/dataTables.bootstrap4.min.js' ) }}"></script> 
    
    <!--test-->
    <!--DataTables Date Selector Scripts-->
    <!--<script src="https://code.jquery.com/jquery-3.5.1.js"></script>-->
    <!--<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.0/js/dataTables.dateTime.min.js"></script>
      
    
    
    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {
    
            $('#date_added').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
    
            $('#date_modified').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
    
            //$('.dataTables-example').DataTable({
            $('#bpTable').DataTable({
                //pageLength: 100,
                
                order: [[8, "desc"]],
                // order: [[0, "asc"]],
                
                // lengthMenu: [[25, 50, 75, -1], [25, 50, 75, "All"]],
                // lengthMenu: [[100, -1], [100, "All"]],
                lengthMenu: [[-1, 25, 50, 75], ["All", 25, 50, 75]],
                // lengthMenu: [[-1], ["All"]],
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv', title: 'Billing Summary'},
                    {extend: 'excel', title: 'Billing Summary'},
                    {extend: 'pdf', title: 'Billing Summary'},
                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');
    
                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]
    
            });
    
        });
        
           //Select Month - Get the text using the value of select
                var text = $("select[name=setmonth] option[value='1']").text();
                //We need to show the text inside the span that the plugin show
                $('.bootstrap-select .filter-option').text(text);
                //Check the selected attribute for the real select
                $('select[name=setmonth]').val(1);
    
    // // From https://datatables.net/extensions/datetime/examples/integration/datatables.html
    //     var minDate, maxDate;
     
    // // Custom filtering function which will search data in column four between two values
    //         $.fn.dataTable.ext.search.push(
    //             function( settings, data, dataIndex ) {
    //                 var min = minDate.val();
    //                 var max = maxDate.val();
    //                 var date = new Date( data[4] );
             
    //                 if (
    //                     ( min === null && max === null ) ||
    //                     ( min === null && date <= max ) ||
    //                     ( min <= date   && max === null ) ||
    //                     ( min <= date   && date <= max )
    //                 ) {
    //                     return true;
    //                 }
    //                 return false;
    //             }
    //         );
             
            $(document).ready(function() {
                // Create date inputs
                minDate = new DateTime($('#date_added'), {
                    //format: 'MMMM Do YYYY' Y-m-d H:i:s
                    //format: 'YYYY-MM-DD H:i:s'
                    format: 'MM/DD/YYYY'
                });
                maxDate = new DateTime($('#date_modified'), {
                    //format: 'MMMM Do YYYY'
                    //format: 'YYYY-MM-DD H:i:s'
                    format: 'MM/DD/YYYY'
                });
             
                // DataTables initialisation
                var table = $('#bpTable').DataTable();
             
                // Refilter the table
                $('#startDate, #endDate').on('change', function () {
                    table.draw();
                });
            });
    
    
    
    </script>
    @endpush
    
    
    
    
    
    
    
    
    
    
    
            