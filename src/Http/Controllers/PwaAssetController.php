<?php

namespace Jonnx\LaravelPwa\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
use Jonnx\LaravelPwa\Actions\CompileManifest;

class PwaAssetController extends Controller
{
	/**
	 * Serve the manifest.json file for the PWA.
	 */
	public function manifest(Request $request)
	{
		$manifestContents = CompileManifest::compile();

		return response()->json($manifestContents);
	}

	/**
	 * Serve the service-worker.js file for the PWA.
	 */
	public function serviceWorker(Request $request)
	{
        // @todo implement this
		$serviceWorkerContents = '// coming soon...';

        return Response::make($serviceWorkerContents, 200, [
            'Content-Type' => 'application/javascript', 
        ]);
	}

    public function offline(Request $request)
    {
        return view('pwa::offline');
    }
}
