<div class="col-xl-3 col-sm-6 mb-3">
    <div class="card">
            <div class="card-body p-3">
                <div class="row">
                <div class="col-8">
                    <div class="numbers">
                    <a href="{{ $url ?? '' }}" style="text-decoration: none; color:#6c757d;">
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">{{ $title }}</p>
                    </a>

                    <h5 class="font-weight-bolder">
                        {{ $numbers }}
                    </h5>
                    <p class="mb-0">
                        <span class="text-{{ $line1Color ?? '' }} text-sm font-weight-bolder">{{ $line1 ?? '' }}</span>
                        {{ $line2 ?? '' }}
                    </p>

                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="dropdown">
                        <div class="icon icon-shape bg-gradient-{{ $iconColor }} shadow-{{ $iconColor }} text-center rounded-circle">
                        <i class="{{ $icon }} text-lg opacity-10" aria-hidden="true"></i>
                        <div class="dropdown-content">
                            <table class="table">
                                <tbody>
                                    @if(isset($line1Win))
                                    <tr>
                                        <td><span class="text-{{ $lineWinColor ?? '' }} text-sm font-weight-bolder">{{ $line1Win ?? '' }}</span></td>
                                        <td>
                                            <a href="{{ $line1Url ?? '' }}">
                                                {{ $line2Win ?? '' }}
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                    @if(isset($line1Lose))
                                    <tr>
                                        <td><span class="text-{{ $lineLoseColor ?? '' }} text-sm font-weight-bolder">{{ $line1Lose ?? '' }}</span></td>
                                        <td>
                                            <a href="{{ $line2Url ?? '' }}">
                                                {{ $line2Lose ?? '' }}
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
    </div>
</div>