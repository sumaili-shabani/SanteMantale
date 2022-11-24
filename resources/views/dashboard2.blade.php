<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2",
	animationEnabled: true,
	title: {
		text: ""
	},
	data: [{
		type: "doughnut",
		indexLabel: "{symbol} - {y}",
		yValueFormatString: "#,##0.0\"%\"",
		showInLegend: true,
		legendText: "{label} : {y}",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<style type="text/css">
	
	.card {
	    position: relative;
	    display: -webkit-box;
	    display: -ms-flexbox;
	    display: flex;
	    -webkit-box-orient: vertical;
	    -webkit-box-direction: normal;
	    -ms-flex-direction: column;
	    flex-direction: column;
	    min-width: 0;
	    word-wrap: break-word;
	    background-color: #fff;
	    background-clip: border-box;
	    border: 1px solid rgba(0, 0, 0, .125);
	    border-radius: .25rem
	}
	.card > hr {
	    margin-right: 0;
	    margin-left: 0
	}
	.card > .list-group:first-child .list-group-item:first-child {
	    border-top-left-radius: .25rem;
	    border-top-right-radius: .25rem
	}
	.card > .list-group:last-child .list-group-item:last-child {
	    border-bottom-right-radius: .25rem;
	    border-bottom-left-radius: .25rem
	}
	.card-body {
	    -webkit-box-flex: 1;
	    -ms-flex: 1 1 auto;
	    flex: 1 1 auto;
	    padding: 1.25rem
	}
	.card-title {
	    margin-bottom: .75rem
	}
	.card-subtitle {
	    margin-top: -.375rem;
	    margin-bottom: 0
	}
	.card-text:last-child {
	    margin-bottom: 0
	}
	.card-link:hover {
	    text-decoration: none
	}
	.card-link + .card-link {
	    margin-left: 1.25rem
	}
	.card-header {
	    padding: .75rem 1.25rem;
	    margin-bottom: 0;
	    background-color: rgba(0, 0, 0, .03);
	    border-bottom: 1px solid rgba(0, 0, 0, .125)
	}
	.card-header:first-child {
	    border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0
	}
	.card-header + .list-group .list-group-item:first-child {
	    border-top: 0
	}
	.card-footer {
	    padding: .75rem 1.25rem;
	    background-color: rgba(0, 0, 0, .03);
	    border-top: 1px solid rgba(0, 0, 0, .125)
	}
	.card-footer:last-child {
	    border-radius: 0 0 calc(.25rem - 1px) calc(.25rem - 1px)
	}
	.card-header-tabs {
	    margin-right: -.625rem;
	    margin-bottom: -.75rem;
	    margin-left: -.625rem;
	    border-bottom: 0
	}
	.card-header-pills {
	    margin-right: -.625rem;
	    margin-left: -.625rem
	}
	.card-img-overlay {
	    position: absolute;
	    top: 0;
	    right: 0;
	    bottom: 0;
	    left: 0;
	    padding: 1.25rem
	}
	.card-img {
	    width: 100%;
	    border-radius: calc(.25rem - 1px)
	}
	.card-img-top {
	    width: 100%;
	    border-top-left-radius: calc(.25rem - 1px);
	    border-top-right-radius: calc(.25rem - 1px)
	}
	.card-img-bottom {
	    width: 100%;
	    border-bottom-right-radius: calc(.25rem - 1px);
	    border-bottom-left-radius: calc(.25rem - 1px)
	}
	.card-deck {
	    display: -webkit-box;
	    display: -ms-flexbox;
	    display: flex;
	    -webkit-box-orient: vertical;
	    -webkit-box-direction: normal;
	    -ms-flex-direction: column;
	    flex-direction: column
	}
	.card-deck .card {
	    margin-bottom: 15px
	}
	@media (min-width:576px) {
	    .card-deck {
	        -webkit-box-orient: horizontal;
	        -webkit-box-direction: normal;
	        -ms-flex-flow: row wrap;
	        flex-flow: row wrap;
	        margin-right: -15px;
	        margin-left: -15px
	    }
	    .card-deck .card {
	        display: -webkit-box;
	        display: -ms-flexbox;
	        display: flex;
	        -webkit-box-flex: 1;
	        -ms-flex: 1 0 0%;
	        flex: 1 0 0%;
	        -webkit-box-orient: vertical;
	        -webkit-box-direction: normal;
	        -ms-flex-direction: column;
	        flex-direction: column;
	        margin-right: 15px;
	        margin-bottom: 0;
	        margin-left: 15px
	    }
	}
	.card-group {
	    display: -webkit-box;
	    display: -ms-flexbox;
	    display: flex;
	    -webkit-box-orient: vertical;
	    -webkit-box-direction: normal;
	    -ms-flex-direction: column;
	    flex-direction: column
	}
	.card-group > .card {
	    margin-bottom: 15px
	}
	@media (min-width:576px) {
	    .card-group {
	        -webkit-box-orient: horizontal;
	        -webkit-box-direction: normal;
	        -ms-flex-flow: row wrap;
	        flex-flow: row wrap
	    }
	    .card-group > .card {
	        -webkit-box-flex: 1;
	        -ms-flex: 1 0 0%;
	        flex: 1 0 0%;
	        margin-bottom: 0
	    }
	    .card-group > .card + .card {
	        margin-left: 0;
	        border-left: 0
	    }
	    .card-group > .card:first-child {
	        border-top-right-radius: 0;
	        border-bottom-right-radius: 0
	    }
	    .card-group > .card:first-child .card-header,
	    .card-group > .card:first-child .card-img-top {
	        border-top-right-radius: 0
	    }
	    .card-group > .card:first-child .card-footer,
	    .card-group > .card:first-child .card-img-bottom {
	        border-bottom-right-radius: 0
	    }
	    .card-group > .card:last-child {
	        border-top-left-radius: 0;
	        border-bottom-left-radius: 0
	    }
	    .card-group > .card:last-child .card-header,
	    .card-group > .card:last-child .card-img-top {
	        border-top-left-radius: 0
	    }
	    .card-group > .card:last-child .card-footer,
	    .card-group > .card:last-child .card-img-bottom {
	        border-bottom-left-radius: 0
	    }
	    .card-group > .card:only-child {
	        border-radius: .25rem
	    }
	    .card-group > .card:only-child .card-header,
	    .card-group > .card:only-child .card-img-top {
	        border-top-left-radius: .25rem;
	        border-top-right-radius: .25rem
	    }
	    .card-group > .card:only-child .card-footer,
	    .card-group > .card:only-child .card-img-bottom {
	        border-bottom-right-radius: .25rem;
	        border-bottom-left-radius: .25rem
	    }
	    .card-group > .card:not(:first-child):not(:last-child):not(:only-child) {
	        border-radius: 0
	    }
	    .card-group > .card:not(:first-child):not(:last-child):not(:only-child) .card-footer,
	    .card-group > .card:not(:first-child):not(:last-child):not(:only-child) .card-header,
	    .card-group > .card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,
	    .card-group > .card:not(:first-child):not(:last-child):not(:only-child) .card-img-top {
	        border-radius: 0
	    }
	}
	.card-columns .card {
	    margin-bottom: .75rem
	}
	@media (min-width:576px) {
	    .card-columns {
	        -webkit-column-count: 3;
	        -moz-column-count: 3;
	        column-count: 3;
	        -webkit-column-gap: 1.25rem;
	        -moz-column-gap: 1.25rem;
	        column-gap: 1.25rem
	    }
	    .card-columns .card {
	        display: inline-block;
	        width: 100%
	    }
	}



</style>
<div class="col-md-12">
	<div class="row">
		<div class="col-md-12">
			

			<div class="container">

				<div class="col-md-12">
					<div class="row">

					

						{{-- bloc1 --}}
						<div class="col-md-3 mb-2">
							<div class="col-md-12">
								<div class="card text-center">
									
									<div class="card-body">
										<h4 class="card-title">Nombre des malades</h4>
										<div class="card-text">
											<h2>{{$mbrMalades}}</h2>
											<p>
												<a href="{{ url('admin/printList_malade') }}" target="_blank" class="text-info">Total des malades.</a>
												
											</p>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						{{-- bloc1 --}}

						{{-- bloc1 --}}
						<div class="col-md-3 mb-2">
							<div class="col-md-12">
								<div class="card text-center">
									
									<div class="card-body">
										<h4 class="card-title">Nombre des consultations</h4>
										<div class="card-text">
											<h2>{{$mbrConsultation}}</h2>
											<p>
												Total des consultations.
											</p>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						{{-- bloc1 --}}

						{{-- bloc1 --}}
						<div class="col-md-3 mb-2">
							<div class="col-md-12">
								<div class="card text-center">
									
									<div class="card-body">
										<h4 class="card-title">Nombre de séance</h4>
										<div class="card-text">
											<h2>{{$mbrSeances}}</h2>
											<p>
												Total de séance.
											</p>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						{{-- bloc1 --}}

						{{-- bloc1 --}}
						<div class="col-md-3 mb-2">
							<div class="col-md-12">
								<div class="card text-center">
									
									<div class="card-body">
										<h4 class="card-title">Nombre des medecins</h4>
										<div class="card-text">
											<h2>{{$mbrInfirmiers}}</h2>
											<p>
												Total des medecins.
											</p>
										</div>
										
									</div>
								</div>
							</div>
						</div>
						{{-- bloc1 --}}

						{{-- bloc1 --}}
						<div class="col-md-12 mb-2 mt-2" style="margin-top: 20px;">
							<div class="col-md-12">
								<div class="card text-center">
									
									<div class="card-body">
										
										<div id="chartContainer" style="height: 250px; width: 100%;"></div>
										
									</div>
								</div>
							</div>
						</div>
						{{-- bloc1 --}}


						
						

					</div>
				</div>
				
			</div>


		</div> 
	</div>
</div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
