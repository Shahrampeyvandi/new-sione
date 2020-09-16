<?php $__env->startSection('content'); ?>
<div class="container-fluid boxShadow p-5">
<div class="card">
    <div class="card-body">

    <div class="row justify-content-center mb-5">
        <div class="col-lg-3 col-sm-6 my-3">
            <a href="#">
                <div class="small-box" style="padding: 20px;
                    box-shadow: 0 6px 20px 0 #71ec62 !important;
                    background: linear-gradient(-45deg,#2a9c05,#71ec62)!important;                    color: #fff;
                    border-radius: 7px;">
                    <div class="inner">
                        <h3 style="color: white !important;"><?php echo e($movies); ?><sup style="font-size: 20px"></sup>
                        </h3>
                        <p class="text-white fs-1-5">سینمایی</p>
                    </div>
                    <div class="fs-2">
                        <i class="fas fa-2x fa-radiation-alt"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-sm-6 my-3">
            <a href="#">
                <div class="small-box" style="padding: 20px;
                    box-shadow: 0 6px 20px 0 #bb52e6!important;
                    background: linear-gradient(-45deg,#70059c,#bb52e6)!important;
                    color: #fff;
                    border-radius: 7px;">
                    <div class="inner">
                        <h3 style="color: white !important;"><?php echo e($series); ?><sup style="font-size: 20px"></sup>
                        </h3>
                        <p class="text-white fs-1-5">سریال </p>
                    </div>
                    <div class="fs-2">
                        <i class="fas fa-2x fa-radiation-alt"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-sm-6 my-3">
            <a href="#">
                <div class="small-box" style="padding: 20px;
                    box-shadow: 0 6px 20px 0 #f971a3 !important;
                    background: linear-gradient(-45deg,#de0067,#f1689a)!important;                   color: #fff;
                    border-radius: 7px;">
                    <div class="inner">
                        <h3 style="color: white !important;"><?php echo e($users); ?><sup style="font-size: 20px"></sup>
                        </h3>
                        <p class="text-white fs-1-5">کاربران </p>
                    </div>
                    <div class="fs-2">
                        <i class="fas fa-2x fa-radiation-alt"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-sm-6 my-3">
            <a href="#">
                <div class="small-box" style=" padding: 20px;
                    box-shadow: 0 6px 20px 0 rgba(255, 53, 19, 0.5)!important;
                    background: linear-gradient(-45deg,#9c1405,#e91d26)!important;
                    color: #fff;
                    border-radius: 7px;">
                    <div class="inner">
                        <h3 style="color: white !important;"><?php echo e($blogs); ?><sup style="font-size: 20px"></sup>
                        </h3>
                        <p class="text-white fs-1-5">وبلاگ </p>
                    </div>
                    <div class="fs-2">
                        <i class="fas fa-2x fa-radiation-alt"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>

  
  <div class="row mt-5">
        <div class="col-md-6">
            <canvas id="visits" width="400" height="400"></canvas>

        </div>
        <div class="col-md-6">
            <canvas id="fileschart" width="400" height="400"></canvas>

        </div>
    </div>

    </div>
</div>




</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    var ctx = document.getElementById('visits');
    var ctx1 = document.getElementById('fileschart');

    window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};
    var details = {
                steppedLine: false,
				label: 'بازدیدهای سایت در یک هفته اخیر',
                color: window.chartColors.red
            }
            var myChart = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: <?php echo $json_posts ?>,
        datasets: [{
            label: 'محتواهای دارای بیشترین آرای مثبت',
            data: <?php echo $json_votes ?>,
            backgroundColor: [
                window.chartColors.blue,
                window.chartColors.blue,
                window.chartColors.blue,
                window.chartColors.blue,
                window.chartColors.blue,
                window.chartColors.blue
            ],
           
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

    var myChart = new Chart(ctx, {
        type: 'line',
			data: {
					labels: <?php echo $day_json ?>,
					datasets: [{
						label: 'تعداد بازدیدها: ',
						steppedLine: details.steppedLine,
						data:<?php echo $visits_json ?>,
						borderColor: details.color,
						fill: false,
					}]
				},
                options: {
					responsive: true,
					title: {
						display: true,
						text: details.label,
					}
				}
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Panel/Dashboard.blade.php ENDPATH**/ ?>