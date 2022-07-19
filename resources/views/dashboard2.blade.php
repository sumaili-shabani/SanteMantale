
<div class="col-md-12">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-12" align="right">
		     	<a href="{{ url('admin/printList_malade') }}" target="_blank" class="btn btn-danger">Convert into PDF</a>
		    </div>
			<p>
				name: {{ $name }}
			</p>
			<p>
				localisation: {{ $data }}
			</p>

			<div class="col-md-12">
				<div class="table-responsive">
				    <table class="table table-striped table-bordered">
				     <thead>
				      <tr>
				       <th>Image</th>
				       <th>Nom</th>
				       <th>Prenom</th>
				       <th>Adresse</th>
				       <th>Téléphone</th>
				       <th>Sexe</th>
				      </tr>
				     </thead>
				     <tbody>
					     @foreach($customer_data as $customer)
					      <tr>
					       <td>{{ $customer->image }}</td>
					       <td>{{ $customer->nom }}</td>
					       <td>{{ $customer->prenom }}</td>
					       <td>{{ $customer->adresse }}</td>
					       <td>{{ $customer->telephone }}</td>
					       <td>{{ $customer->sexe }}</td>
					      </tr>
					     @endforeach
				     </tbody>
				     <tfoot>
				      <tr>
				       <th>Image</th>
				       <th>Nom</th>
				       <th>Prenom</th>
				       <th>Adresse</th>
				       <th>Téléphone</th>
				       <th>Sexe</th>
				      </tr>
				     </tfoot>
				    </table>
				</div>
			</div>

			<div style="margin-top: 300px;"></div>

			


			



		</div> 
	</div>
</div>