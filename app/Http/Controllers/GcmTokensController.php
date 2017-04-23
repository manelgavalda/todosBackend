<?php
namespace ManelGavalda\TodosBackend\Http\Controllers;

use ManelGavalda\TodosBackend\Notifications\GcmTokenCreated;
use Auth;
use Illuminate\Http\Request;
/**
 * Class GcmTokensController.
 *
 * @package ManelGavalda\TodosBackend\Http\Controllers
 */
class GcmTokensController extends TodosBaseController
{
    /**
     * Add gcm token to user.
     */
    public function addToken(Request $request)
    {
        $user = $request->user();
        $token = $user->gcmTokens()->firstOrCreate([
            'registration_id' => $request->input('registration_id')
        ]);
        //Broadcast
        broadcast(new GcmTokenCreated($user,$token))->toOthers();
        return ['status' => 'Token saved!'];
    }
}