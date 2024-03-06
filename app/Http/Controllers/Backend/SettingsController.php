<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\SocialLinks;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    public function SiteSettings(){
        $site = Settings::find(1);
        return view('backend.settings.site_settings', compact('site'));
    }//end method

    public function UpdateSiteSettings(Request $request){

        $site_id = $request->id;

        // Handle Logo White
   if ($request->file('logo')) {
       $logoImage = $request->file('logo');
       $logoName = hexdec(uniqid()) . '.' . $logoImage->getClientOriginalExtension();
       Image::make($logoImage)->resize(150, 150)->save('upload/settings/' . $logoName);
       $logoUrl = 'upload/settings/' . $logoName;
   }

   // Handle Logo Dark

   if ($request->file('favicon')) {
       $faviconImage = $request->file('favicon');
       $faviconName = hexdec(uniqid()) . '.' . $faviconImage->getClientOriginalExtension();
       Image::make($faviconImage)->resize(32, 32)->save('upload/settings/' . $faviconName);
       $faviconUrl = 'upload/settings/' . $faviconName;

           
               $site = Settings::findOrFail($site_id);

               $site->update([

                'website_name' => $request->website_name,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'logo' => isset($logoUrl) ? $logoUrl : $site->logo,
                'favicon' => isset($faviconUrl) ? $faviconUrl : $site->favicon, 
            ]);

            $notification = array(
                'message' => 'Site Setting Updated with image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);


        } else {

            Settings::findOrFail($site_id)->update([

                'website_name' => $request->website_name,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram, 
            ]);

            $notification = array(
                'message' => 'Site Setting Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        } // End Else 
    }// End Method 


    public function SocialLinks(){
        $social_links = SocialLinks::find(1);
        return view('backend.settings.social_links', compact('social_links'));
    }// End Method 


    public function UpdateSocialLinks(Request $request){
            $site_id = $request->id;
               $site = SocialLinks::findOrFail($site_id);
               $site->update([
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram, 
            ]);
            $notification = array(
                'message' => 'Site Setting Updated with image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
 
    }// End Method 


 

 
}
