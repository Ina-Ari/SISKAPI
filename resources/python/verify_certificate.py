import cv2
import numpy as np
import sys
import os

def verify_certificate(target_path):
    # Menggunakan path relatif karena file logo berada di direktori yang sama dengan script Python

    logo_img = cv2.imread('D:/laragon/www/siskkm/resources/python/logo pnb.png', 0)

    # Cek apakah gambar logo berhasil dibaca
    # if logo_img is None:
    #     print(f"Error: Gambar logo tidak ditemukan!")
    #     return "Tidak Terverifikasi"

    sertif_img = cv2.imread(target_path, 0)

    brisk = cv2.BRISK_create()
    kp1, des1 = brisk.detectAndCompute(logo_img, None)
    kp2, des2 = brisk.detectAndCompute(sertif_img, None)

    index_params = dict(algorithm=6, table_number=6, key_size=12, multi_probe_level=1)
    search_params = dict(checks=100)
    flann = cv2.FlannBasedMatcher(index_params, search_params)
    matches = flann.knnMatch(des1, des2, k=2)

    good_matches = []
    for m in matches:
        if len(m) == 2:
            match1, match2 = m
            if match1.distance < 0.85 * match2.distance:
                good_matches.append([match1])

    min_features = min(len(kp1), len(kp2))
    match_percentage = (len(good_matches) / min_features) * 1000 if min_features > 0 else 0

    status = "Terverifikasi" if match_percentage > 80 else "Tidak Terverifikasi"
    return f"{status}|{match_percentage:.2f}"


if __name__ == "__main__":
    target_path = sys.argv[1]
    result = verify_certificate(target_path)
    print(result)
