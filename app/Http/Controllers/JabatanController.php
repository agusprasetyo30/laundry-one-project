<?php

namespace App\Http\Controllers;

use App\Repositories\JabatanRepository;
use App\Services\JabatanService;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    protected JabatanRepository $jabatanRepository;
    protected JabatanService $jabatanService;

    public function __construct(JabatanRepository $jabatanRepository, JabatanService $jabatanService) {
        $this->jabatanRepository = $jabatanRepository;
        $this->jabatanService = $jabatanService;
    }

    public function datatables(Request $request) {
        $pagination = $this->jabatanService->getPaginationParams($request);
        $filters = $this->jabatanService->getFiltersParams($request);

        $params = array_merge($filters['params'], [$pagination['startRow'], $pagination['endRow']]);

        // ini kenapa dipisah, karena untuk getData() ini filter yang diambil filter yang bersifat dinamis (selain filter tanggal)
        $data = $this->jabatanRepository->getData($params, $filters['whereSearch']);
    }
}
