<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Throwable;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;

class LeadController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            $perPage = max(1, min($request->integer('per_page', 10), 100));
            $page = max(1, $request->integer('page', 1));

            $leads = Lead::with('vehicle')
                ->paginate($perPage, ['*'], 'page', $page);

            return response()->json([
                'success' => true,
                'message' => 'Leads retrieved successfully',
                'data' => $leads->items(),
                'meta' => [
                    'current_page' => $leads->currentPage(),
                    'last_page' => $leads->lastPage(),
                    'per_page' => $leads->perPage(),
                    'total' => $leads->total(),
                ]
            ]);
        } catch (Throwable $e) {
            return $this->errorResponse('Failed to retrieve leads', $e);
        }
    }

    public function store(StoreLeadRequest $request): JsonResponse
    {
        try {
            $lead = Lead::create($request->validated());

            // carrega veículo junto
            $lead->load('vehicle');

            return response()->json([
                'success' => true,
                'message' => 'Lead created successfully',
                'data' => $lead
            ], 201);
        } catch (QueryException $e) {
            return $this->errorResponse('Database error while creating lead', $e);
        } catch (Throwable $e) {
            return $this->errorResponse('Unexpected error', $e);
        }
    }

    public function show(Lead $lead): JsonResponse
    {
        try {
            $lead->load('vehicle');

            return response()->json([
                'success' => true,
                'message' => 'Lead retrieved successfully',
                'data' => $lead
            ]);
        } catch (Throwable $e) {
            return $this->errorResponse('Failed to retrieve lead', $e);
        }
    }

    public function update(UpdateLeadRequest $request, Lead $lead): JsonResponse
    {
        try {
            $lead->update($request->validated());

            $lead->load('vehicle');

            return response()->json([
                'success' => true,
                'message' => 'Lead updated successfully',
                'data' => $lead
            ]);
        } catch (QueryException $e) {
            return $this->errorResponse('Database error while updating lead', $e);
        } catch (Throwable $e) {
            return $this->errorResponse('Unexpected error', $e);
        }
    }

    public function destroy(Lead $lead): JsonResponse
    {
        try {
            $lead->delete();

            return response()->json([
                'success' => true,
                'message' => 'Lead deleted successfully'
            ]);
        } catch (QueryException $e) {
            return $this->errorResponse('Database error while deleting lead', $e);
        } catch (Throwable $e) {
            return $this->errorResponse('Unexpected error', $e);
        }
    }

    //listar leads por veículo
    public function byVehicle($vehicleId): JsonResponse
    {
        try {
            $leads = Lead::where('vehicle_id', $vehicleId)
                ->with('vehicle')
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Leads for vehicle retrieved successfully',
                'data' => $leads
            ]);
        } catch (Throwable $e) {
            return $this->errorResponse('Failed to retrieve leads for vehicle', $e);
        }
    }

    private function errorResponse(string $message, Throwable $e, int $code = 500): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'error' => app()->environment('local') ? $e->getMessage() : null
        ], $code);
    }
}