@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Dashboard Laporan</h2>

    <div class="row d-none d-md-flex">
        <!-- Tampilan Desktop (2 Kolom) -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">Revenue Per Bulan</div>
                <div class="card-body">
                    <canvas id="monthlyRevenueChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-success text-white">Revenue Per Tahun</div>
                <div class="card-body">
                    <canvas id="yearlyRevenueChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-4">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">Jumlah Transaksi Per Bulan</div>
                <div class="card-body">
                    <canvas id="monthlySalesChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-4">
            <div class="card shadow">
                <div class="card-header bg-danger text-white">Jumlah Transaksi Per Tahun</div>
                <div class="card-body">
                    <canvas id="yearlySalesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Tampilan Mobile (Slider) -->
    <div class="d-md-none">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">Revenue Per Bulan</div>
                        <div class="card-body">
                            <canvas id="monthlyRevenueChartMobile"></canvas>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="card shadow">
                        <div class="card-header bg-success text-white">Revenue Per Tahun</div>
                        <div class="card-body">
                            <canvas id="yearlyRevenueChartMobile"></canvas>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="card shadow">
                        <div class="card-header bg-warning text-white">Jumlah Transaksi Per Bulan</div>
                        <div class="card-body">
                            <canvas id="monthlySalesChartMobile"></canvas>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="card shadow">
                        <div class="card-header bg-danger text-white">Jumlah Transaksi Per Tahun</div>
                        <div class="card-body">
                            <canvas id="yearlySalesChartMobile"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Navigasi Slider -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>

<!-- Load Chart.js dan Swiper -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">

<script>
    // Data Revenue Per Bulan
    var monthlyRevenueLabels = {!! json_encode($monthlyRevenue->pluck('month')->map(fn($m) => date('F', mktime(0, 0, 0, $m, 1)))) !!};
    var monthlyRevenueData = {!! json_encode($monthlyRevenue->pluck('total_fee')) !!};

    function createChart(ctx, type, labels, data, color) {
        new Chart(ctx, {
            type: type,
            data: {
                labels: labels,
                datasets: [{
                    label: 'Revenue (Rp)',
                    data: data,
                    backgroundColor: color
                }]
            }
        });
    }

    createChart(document.getElementById('monthlyRevenueChart').getContext('2d'), 'bar', monthlyRevenueLabels, monthlyRevenueData, 'rgba(54, 162, 235, 0.6)');
    createChart(document.getElementById('monthlyRevenueChartMobile').getContext('2d'), 'bar', monthlyRevenueLabels, monthlyRevenueData, 'rgba(54, 162, 235, 0.6)');

    // Data Revenue Per Tahun
    var yearlyRevenueLabels = {!! json_encode($yearlyRevenue->pluck('year')) !!};
    var yearlyRevenueData = {!! json_encode($yearlyRevenue->pluck('total_fee')) !!};

    createChart(document.getElementById('yearlyRevenueChart').getContext('2d'), 'line', yearlyRevenueLabels, yearlyRevenueData, 'rgba(75, 192, 192, 0.6)');
    createChart(document.getElementById('yearlyRevenueChartMobile').getContext('2d'), 'line', yearlyRevenueLabels, yearlyRevenueData, 'rgba(75, 192, 192, 0.6)');

    // Data Sales Per Bulan
    var monthlySalesLabels = {!! json_encode($monthlySales->pluck('month')->map(fn($m) => date('F', mktime(0, 0, 0, $m, 1)))) !!};
    var monthlySalesData = {!! json_encode($monthlySales->pluck('total_sales')) !!};

    createChart(document.getElementById('monthlySalesChart').getContext('2d'), 'bar', monthlySalesLabels, monthlySalesData, 'rgba(255, 206, 86, 0.6)');
    createChart(document.getElementById('monthlySalesChartMobile').getContext('2d'), 'bar', monthlySalesLabels, monthlySalesData, 'rgba(255, 206, 86, 0.6)');

    // Data Sales Per Tahun
    var yearlySalesLabels = {!! json_encode($yearlySales->pluck('year')) !!};
    var yearlySalesData = {!! json_encode($yearlySales->pluck('total_sales')) !!};

    createChart(document.getElementById('yearlySalesChart').getContext('2d'), 'line', yearlySalesLabels, yearlySalesData, 'rgba(255, 99, 132, 0.6)');
    createChart(document.getElementById('yearlySalesChartMobile').getContext('2d'), 'line', yearlySalesLabels, yearlySalesData, 'rgba(255, 99, 132, 0.6)');

    // Swiper untuk tampilan mobile
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
</script>
@endsection
