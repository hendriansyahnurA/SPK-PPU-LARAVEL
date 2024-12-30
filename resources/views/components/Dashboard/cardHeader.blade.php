<div class="row justify-content-center">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Evaluator</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $evaluatorCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-solid fa-user-tie fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Peserta</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $peserta->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-solid fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
