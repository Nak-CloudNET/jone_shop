<?php 
	//$this->erp->print_arrays($rows);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="<?php echo $assets ?>styles/theme.css" rel="stylesheet">
    <style type="text/css">
        html, body {
            height: 100%;
            background: #FFF;
        }
        body:before, body:after {
            display: none !important;
			 
        }
        .btn {
            border-radius: 0 !important;
            margin-right: 10px;
        }
		.moul{
		  font-family: Khmer OS Muol;
		}
		p,li{
			font-family: Khmer OS Battambang;
			line-height: 1.8;
			font-size: 15px;
		}

		/*p{
    	text-align:justify;
		}
		p:after {
		    content: "";
		    display: inline-block;
		    width: 100%;    
		}*/
		.foot{
			 font-family: Khmer OS Battambang;
		}
		li{
		  text-indent: -2em;
		}
		input[type=checkbox]{
			 font-size:15px;
		}
    </style>
</head>

<body>
<!-- <input type="button" value="Print Div" onclick="PrintElem('#mydiv')" /> -->
		<div class="container">
			<div class="row col-lg-12">
				<div class="col-lg-12">
					<h3 class='text-center moul'><b>ពាក្យស្នើរសុំទិញ-លក់ផ្ទះ</b></h3><br><br>
				</div>
				<div class="col-lg-10 col-lg-offset-2">
						<p>ធ្វើនៅថ្ងៃទី <?php echo $date_day ?> ខែ <?php echo $date_month ?> ឆ្នាំ <?php echo $date_year ?></p>
						<p>១. អ្នកទិញ : លោក/លោកស្រី
							<span style="padding-right: 20px !important;"><b> 
								<?php
								if($customer->name_kh || $inv->customer){
									if($customer->name_kh){
										echo $customer->name_kh;}else{echo $inv->customer;}
								}else{
									echo "………………………";
								}
								?>
							</b></span>
							អត្ត/ប័ណ្ណ
								<span style="padding-right: 18px !important;"><b> 
									<?php if($customer->cf1 == null){echo "……………………";}else{echo $customer->cf1;} ?> 
								</b></span>
							និងឈ្មោះ
								<span style="padding: 18px !important;"><b>………………………</b></span>
						</p>
						<p>
							អត្ត/ប័ណ្ណ
								<span style="padding-right: 18px !important;"><b>…………………</b></span> 
							អាស័យដ្ឋានផ្ទះលេខ 
								<span style="padding-right: 18px !important;"><b>
									<?php if($customer->address == null){echo "………………";}else{echo $customer->address;} ?>	
								</b></span>
							ផ្លូវលេខ 
								<span style="padding-right: 18px !important;"><b>
									<?php if($customer->street == null){echo "…………";}else{echo $customer->street;} ?>
								</b></span>
							ភូមិ
								<span style="padding: 18px !important;"><b>
									<?php if($customer->village == null){echo "…………………………";}else{echo $customer->village;} ?>
								</b></span>
						</p>
						<p>
							ឃុំ/សង្កាត់
							<span style="padding-right: 18px !important;"><b>
								<?php if($customer->sangkat == null){echo "…………………";}else{echo $customer->sangkat;} ?>
							</b></span>
							ស្រុក/ខ័ណ្ឌ 
								<span style="padding-right: 18px !important;"><b>
									<?php if($customer->district  == null){echo "……………………………………";}else{echo $customer->district ;} ?>
								</b></span> 
							ខេត្ត/រាជធានី
								<span style="padding: 18px !important;"><b> 
									<?php if($customer->city){echo $customer->city;}else{echo $customer->state;} ?>
								</b></span>	
						</p>
						<p>២. ការទិញលក់: ប្រភេទផ្ទះ
								<span style="padding: 18px !important;"><b>…………</b></span>
							ដែលមានទទឹង
								<span style="padding: 18px !important;"><b>…………</b></span>
							ម៉ែត្រ, បណ្ដោយ
								<span style="padding: 18px !important;"><b>…………</b></span>
							ម៉ែត្រ
						</p>
						<p>ផ្ទះលេខ
								<span style="padding-right: 18px !important;"><b>…………</b></span>
							ផ្លូវលេខ
								<span style="padding-right: 18px !important;"><b>………………</b></span>
							ទីតាំង
								<span style="padding-right: 18px !important;"><b>………………</b></span>
							រយះពេលសាងសង់
								<span style="padding-right: 18px !important;"><b>………………</b></span>
							ខែ
						</p>
						<p>តម្លៃដើម
								<span style="padding-right: 18px !important;"><b>……………………</b></span>
							US$ បញ្ចុះតម្លៃ
								<span style="padding-right: 18px !important;"><b>……………………..</b></span>
							US$ តម្លៃលក់
								<span style="padding-right: 18px !important;"><b>…………………</b></span>
							US$
						</p>
						<p>តាមរយ:
								<span style="padding-right: 18px !important;"><b>……………………</b></span>
							បរិយាយ
								<span style="padding-right: 18px !important;"><b>………………………………………………………………………………</b></span>
						</p>
						<p><b>…………………………………………………………………………………………………………………………….</b></p>
						<form action="" method="get">
							<p>
								<span>៣. គោលការណ៍បង់ :    </span>			           			
									<input type="checkbox" value=""> ដំណាក់កាល
										<span style="padding-right: 18px !important;"><b>………………</b></span>
									<input type="checkbox" value=""> ផ្ដាច់
										<span style="padding-right: 18px !important;"><b>………………</b></span>
									<input type="checkbox" value=""> រំលស់
										<span style="padding-right: 18px !important;"><b>……………………</b></span>
							</p>
						</form>
						<p>
							- ប្រាក់កក់ដំបូង
								<span style="padding-right: 18px !important;">……</span>
							$ ថ្ងៃទី
								<span style="padding-right: 18px !important;">…</span>
							ខែ
								<span style="padding-right: 18px !important;">…</span>
							ឆ្នាំ
								<span style="padding-right: 18px !important;">…</span>
							- លើកទី៤
								<span style="padding-right: 18px !important;">……………</span>
							$ ថ្ងៃទី
								<span style="padding-right: 18px !important;">…</span>
							ខែ
								<span style="padding-right: 18px !important;">…</span>
							ឆ្នាំ
								<span style="padding-right: 18px !important;">…</span>
						</p>
						<p>
							- លើកទី១
								<span style="padding-right: 9px !important;">……………</span>
							$ ថ្ងៃទី
								<span style="padding-right: 18px !important;">…</span>
							ខែ
								<span style="padding-right: 18px !important;">…</span>
							ឆ្នាំ
								<span style="padding-right: 18px !important;">…</span>
							- លើកទី៥
								<span style="padding-right: 18px !important;">……………</span>
							$ ថ្ងៃទី
								<span style="padding-right: 18px !important;">…</span>
							ខែ
								<span style="padding-right: 18px !important;">…</span>
							ឆ្នាំ
								<span style="padding-right: 18px !important;">…</span>
						</p>
						<p>
							- លើកទី២
								<span style="padding-right: 9px !important;">……………</span>
							$ ថ្ងៃទី
								<span style="padding-right: 18px !important;">…</span>
							ខែ
								<span style="padding-right: 18px !important;">…</span>
							ឆ្នាំ
								<span style="padding-right: 18px !important;">…</span>
							- លើកទី៦
								<span style="padding-right: 18px !important;">……………</span>
							$ ថ្ងៃទី
								<span style="padding-right: 18px !important;">…</span>
							ខែ
								<span style="padding-right: 18px !important;">…</span>
							ឆ្នាំ
								<span style="padding-right: 18px !important;">…</span>
						</p>
						<p>
							- លើកទី៣
								<span style="padding-right: 9px !important;">……………</span>
							$ ថ្ងៃទី
								<span style="padding-right: 18px !important;">…</span>
							ខែ
								<span style="padding-right: 18px !important;">…</span>
							ឆ្នាំ
								<span style="padding-right: 18px !important;">…</span>
							- លើកទី៧
								<span style="padding-right: 18px !important;">……………</span>
							$ ថ្ងៃទី
								<span style="padding-right: 18px !important;">…</span>
							ខែ
								<span style="padding-right: 18px !important;">…</span>
							ឆ្នាំ
								<span style="padding-right: 18px !important;">…</span>
						</p>
						<p>**បង់ផ្ដាច់
								<span style="padding-right: 9px !important;">…………….</span>
							$ ក្រោយពេលផ្ទះសាងសង់រួចរាល់
						</p>
						<p>**បង់ដំណាក់កាល
								<span style="padding-right: 18px !important;">……………</span>
							$ ក្រោយពេលផ្ទះសាងសង់រួចរាល់ ដោយគិតចាប់ពីថ្ងៃទី
								<span style="padding-right: 18px !important;">…</span>
							ខែ
								<span style="padding-right: 18px !important;">…</span>
							ឆ្នាំ
								<span style="padding-right: 18px !important;">…</span>
						</p>
						<p>
							**រំលស់
								<span style="padding-right: 18px !important;">……………………….</span>
							$សំរាប់រយះពេល<span style="padding-right: 18px !important;">…</span>ឆ្នាំ(<span style="padding-right: 18px !important;">…</span>ខែ) ដោយគិតចាប់ពីថ្ងៃទី
								<span style="padding-right: 18px !important;">…</span>
							ខែ
								<span style="padding-right: 18px !important;">…</span>
							ឆ្នាំ
								<span style="padding-right: 18px !important;">…</span>
						</p>
						<div class='row col-lg-12'>
							<p><span style='margin-left: 10%'>អ្នកទិញ</span>
							<span style='margin-left: 11%'>អ្នកលក់</span>
							<span style='margin-left: 11%'>អ្នកពិនិត្យ</span>
							<span style='margin-left: 11%'>អ្នកអនុញ្ញាត</span></p>
						</div><br><br><br><br><br>
						<p>
							ឈ្មោះ
								<span style="padding-right: 18px !important;">…………….</span>
							ឈ្មោះ
								<span style="padding-right: 18px !important;">…………….</span>
							ឈ្មោះ
								<span style="padding-right: 18px !important;">…………….</span>
							ឈ្មោះ
								<span style="padding-right: 18px !important;">…………….</span>
							ឈ្មោះ
								<span style="padding-right: 18px !important;">…………….</span>
						</p>
						<p>
							ទូរស័ព្ទ
								<span style="padding-right: 18px !important;">……………</span>
							ទូរស័ព្ទ
								<span style="padding-right: 18px !important;">……………</span>
							ទូរស័ព្ទ
								<span style="padding-right: 18px !important;">……………</span>
							ទូរស័ព្ទ
								<span style="padding-right: 18px !important;">……………</span>
							ទូរស័ព្ទ
								<span style="padding-right: 18px !important;">…………….</span>
						</p>
						<p>
							ថ្ងៃទី
								<span style="padding-right: 18px !important;">……………….</span>
							ថ្ងៃទី
								<span style="padding-right: 18px !important;">……………….</span>
							ថ្ងៃទី
								<span style="padding-right: 18px !important;">……………….</span>
							ថ្ងៃទី
								<span style="padding-right: 18px !important;">……………….</span>
							ថ្ងៃទី
								<span style="padding-right: 18px !important;">……………….</span>
						</p>
						<p><u>បញ្ជាក់</u> : ប្រាក់ដែលកក់រួច មិនអាចដកវិញបានទេ ។</p>
						<p​ class='foot'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ប្រសិនបើអ្នកទិញមិនបានបង់ប្រាក់បន្ថែមតាមកំណត់នោះ​ ប្រាក់កក់នឹងចាត់ទុកជាមោឃៈដោយស្វ័យប្រវិិត្ត</p>
						<br>
						<div style="font-size: 12px;color:#006666" class='foot'>
							<span>បុរី អាទាំងមាស​ ( គំរោងឌឹផ្លរ៉ា )</span><br>
							<span>ការិយាល័យកណ្ដាល: សង្កាត់បាក់ខែង ខ័ណ្ឌជ្រោយចង្វា រាជធានីភ្នំពេញ</span><br>
							<span>ទូរស័ព្ទលេខ: 061 77 67 67 / 097 777 0678 គេហទំព័រ : www.boreytheflora.com</span>
						</div>
				</div>
               </div>
            </div>

</body>
</html>