<?php

namespace App\Http\Controllers;

use App\Models\MembershipPlan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\ApiResponseService;
use Illuminate\Validation\ValidationException;

class MembershipPlanController extends Controller
{
    protected ApiResponseService $apiResponse;

    public function __construct(ApiResponseService $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function index(): JsonResponse
    {
        try {
            $plans = MembershipPlan::all();
            return $this->apiResponse->success($plans, 'Membership plans fetched successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch membership plans', 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'month_count' => 'required|integer|min:1',
                'ads_per_month' => 'required|integer|min:0',
                'price' => 'required|numeric|min:0',
                'promotion_voucher_cost' => 'nullable|numeric|min:0',
                'valid_month' => 'required|integer|min:1',
            ]);

            $plan = MembershipPlan::create($validated);

            return $this->apiResponse->success($plan, 'Membership plan created successfully', 201);
        } catch (ValidationException $e) {
            return $this->apiResponse->error($e->getMessage(), 'Validation failed', 422);
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to create membership plan', 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $plan = MembershipPlan::find($id);

            if (!$plan) {
                return $this->apiResponse->error('Membership plan not found', 'No plan with given ID', 404);
            }

            return $this->apiResponse->success($plan, 'Membership plan fetched successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to fetch membership plan', 500);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $plan = MembershipPlan::find($id);

            if (!$plan) {
                return $this->apiResponse->error('Membership plan not found', 'No plan with given ID', 404);
            }

            $validated = $request->validate([
                'month_count' => 'sometimes|required|integer|min:1',
                'ads_per_month' => 'sometimes|required|integer|min:0',
                'price' => 'sometimes|required|numeric|min:0',
                'promotion_voucher_cost' => 'nullable|numeric|min:0',
                'valid_month' => 'sometimes|required|integer|min:1',
            ]);

            $plan->update($validated);

            return $this->apiResponse->success($plan, 'Membership plan updated successfully');
        } catch (ValidationException $e) {
            return $this->apiResponse->error($e->getMessage(), 'Validation failed', 422);
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to update membership plan', 500);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $plan = MembershipPlan::find($id);

            if (!$plan) {
                return $this->apiResponse->error('Membership plan not found', 'No plan with given ID', 404);
            }

            $plan->delete();
            return $this->apiResponse->success(null, 'Membership plan deleted successfully');
        } catch (\Exception $e) {
            return $this->apiResponse->error($e->getMessage(), 'Failed to delete membership plan', 500);
        }
    }
}
