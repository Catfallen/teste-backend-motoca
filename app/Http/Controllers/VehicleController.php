<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use Illuminate\Http\Request;
use Throwable;

class VehicleController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            // Validação simples de filtro
            if ($request->filled('type') && !in_array($request->type, ['car', 'motorcycle'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid type filter'
                ], 422);
            }

            $query = Vehicle::query();

            // Filtros
            if ($request->filled('type')) {
                $query->where('type', $request->type);
            }

            if ($request->filled('max_price')) {
                $query->where('price', '<=', $request->max_price);
            }

            // Paginação segura
            $perPage = max(1, min($request->integer('per_page', 10), 100));
            $page = max(1, $request->integer('page', 1));

            $vehicles = $query->paginate($perPage, ['*'], 'page', $page);

            return response()->json([
                'success' => true,
                'message' => 'Vehicles retrieved successfully',
                'data' => $vehicles->items(),
                'meta' => [
                    'current_page' => $vehicles->currentPage(),
                    'last_page' => $vehicles->lastPage(),
                    'per_page' => $vehicles->perPage(),
                    'total' => $vehicles->total(),
                ],
                'links' => [
                    'first' => $vehicles->url(1),
                    'last' => $vehicles->url($vehicles->lastPage()),
                    'prev' => $vehicles->previousPageUrl(),
                    'next' => $vehicles->nextPageUrl(),
                ]
            ]);
        } catch (Throwable $e) {
            return $this->errorResponse('Failed to retrieve vehicles', $e);
        }
    }

    public function store(StoreVehicleRequest $request): JsonResponse
    {
        try {
            $vehicle = Vehicle::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Vehicle created successfully',
                'data' => $vehicle
            ], 201);
        } catch (QueryException $e) {
            return $this->errorResponse('Database error while creating vehicle', $e);
        } catch (Throwable $e) {
            return $this->errorResponse('Unexpected error', $e);
        }
    }

    public function show(Vehicle $vehicle): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Vehicle retrieved successfully',
                'data' => $vehicle
            ]);
        } catch (Throwable $e) {
            return $this->errorResponse('Failed to retrieve vehicle', $e);
        }
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle): JsonResponse
    {
        try {
            $vehicle->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Vehicle updated successfully',
                'data' => $vehicle
            ]);
        } catch (QueryException $e) {
            return $this->errorResponse('Database error while updating vehicle', $e);
        } catch (Throwable $e) {
            return $this->errorResponse('Unexpected error', $e);
        }
    }

    public function destroy(Vehicle $vehicle): JsonResponse
    {
        try {
            $vehicle->delete();

            return response()->json([
                'success' => true,
                'message' => 'Vehicle deleted successfully'
            ]);
        } catch (QueryException $e) {
            return $this->errorResponse('Database error while deleting vehicle', $e);
        } catch (Throwable $e) {
            return $this->errorResponse('Unexpected error', $e);
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