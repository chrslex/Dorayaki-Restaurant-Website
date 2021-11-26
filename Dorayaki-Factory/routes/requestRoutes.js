import express from "express";
import {
    getAllRequest,
    acceptRequest,
    declineRequest,
    getRequestByIP,
    addRequest
} from "../controllers/request.js";

const router = express.Router();

router.get('/', getAllRequest);
router.patch('/acc/:id/:nama_varian', acceptRequest);
router.patch('/dec/:id', declineRequest);
router.get('/:ip', getRequestByIP);
router.post('/add',addRequest)

export default router;