      <!-- Sale & Revenue Start -->
      <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-wrench fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Inspeksi</p>
                        <h6 class="mb-0">{{ $data['jmlInspeksi'] }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-tractor fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Alat Berat</p>
                        <h6 class="mb-0">{{ $data['jmlAlatberat'] }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-users fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Users</p>
                        <h6 class="mb-0">{{ $data['jmlAnggota'] }}</h6>
                    </div>
                </div>
            </div>
             <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 border border-warning">
                    <i class="fas fa-clock fa-3x text-warning"></i>
                    <div class="ms-3">
                        <p class="mb-2">Pending</p>
                        <h6 class="mb-0">{{ $statusData['pending'] }}</h6>
                    </div>
                </div>
            </div>
             <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 border border-success">
                    <i class="fas fa-thumbs-up fa-3x text-success"></i>
                    <div class="ms-3">
                        <p class="mb-2">Approved</p>
                        <h6 class="mb-0">{{ $statusData['approved'] }}</h6>
                    </div>
                </div>
            </div>
             <div class="col-sm-6 col-xl-4">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 border border-danger">
                    <i class="fas fa-window-close fa-3x text-danger"></i>
                    <div class="ms-3">
                        <p class="mb-2">Cancel</p>
                        <h6 class="mb-0">{{ $statusData['cancel'] }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->
